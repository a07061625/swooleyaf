<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:32
 */
namespace SyServer;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use Exception\Swoole\ServerException;
use Log\Log;
use Response\Result;
use Tool\Dir;
use Tool\SyPack;
use Tool\Tool;
use Traits\BaseServerTrait;
use Traits\Server\BasicBaseTrait;
use Yaf\Application;

abstract class BaseServer {
    use BasicBaseTrait;
    use BaseServerTrait;

    /**
     * 请求服务对象
     * @var \swoole_websocket_server|\swoole_server
     */
    protected $_server = null;
    /**
     * 请求域名
     * @var string
     */
    protected $_host = '';
    /**
     * 请求端口
     * @var int
     */
    protected $_port = 0;
    /**
     * @var \Yaf\Application
     */
    protected $_app = null;
    /**
     * task进程数量
     * @var int
     */
    protected $_taskNum = 0;
    /**
     * 最大task进程ID号
     * @var int
     */
    protected $_taskMaxId = -1;
    /**
     * pid文件
     * @var string
     */
    protected $_pidFile = '';
    /**
     * 配置数组
     * @var array
     */
    protected $_configs = [];
    /**
     * @var \Tool\SyPack
     */
    protected $_syPack = null;
    /**
     * 提示文件
     * @var string
     */
    protected $_tipFile = '';
    /**
     * 请求ID
     * @var string
     */
    protected static $_reqId = '';
    /**
     * 请求开始毫秒级时间戳
     * @var float
     */
    protected static $_reqStartTime = 0.0;
    /**
     * 服务token码,用于标识不同的服务,每个服务的token不一样
     * @var string
     */
    protected static $_serverToken = '';
    /**
     * 唯一码,作为服务端的唯一标识
     * @var string
     */
    protected static $_uniqueToken = '';

    /**
     * BaseServer constructor.
     * @param int $port 端口
     */
    public function __construct(int $port) {
        if (($port <= 1000) || ($port > 65535)) {
            exit('端口不合法' . PHP_EOL);
        }
        $this->checkSystemEnv();
        $this->_configs = Tool::getConfig('syserver.' . SY_ENV . SY_MODULE);

        define('SY_SERVER_IP', $this->_configs['server']['host']);
        define('SY_REQUEST_MAX_HANDLING', (int)$this->_configs['server']['request']['maxnum']['handling']);

        $this->_configs['server']['port'] = $port;
        //关闭协程
        $this->_configs['swoole']['enable_coroutine'] = false;
        //日志
        $this->_configs['swoole']['log_level'] = SWOOLE_LOG_TRACE;
        $this->_configs['swoole']['trace_flags'] = SWOOLE_TRACE_SERVER | SWOOLE_TRACE_WORKER | SWOOLE_TRACE_PHP;
        //开启TCP快速握手特性,可以提升TCP短连接的响应速度
        $this->_configs['swoole']['tcp_fastopen'] = true;
        //启用异步安全重启特性,Worker进程会等待异步事件完成后再退出
        $this->_configs['swoole']['reload_async'] = true;
        //进程最大等待时间,单位为秒
        $this->_configs['swoole']['max_wait_time'] = 60;
        //设置每次请求发送最大数据包尺寸,单位为字节
        $this->_configs['swoole']['socket_buffer_size'] = Server::SERVER_PACKAGE_MAX_LENGTH;
        $this->_configs['swoole']['buffer_output_size'] = Server::SERVER_OUTPUT_MAX_LENGTH;
        $taskNum = isset($this->_configs['swoole']['task_worker_num']) ? (int)$this->_configs['swoole']['task_worker_num'] : 0;
        if($taskNum < 2){
            exit('Task进程的数量必须大于等于2' . PHP_EOL);
        }
        $this->_taskNum = $taskNum;
        $this->_taskMaxId = $taskNum - 1;
        $this->_host = $this->_configs['server']['host'];
        $this->_port = $this->_configs['server']['port'];
        $this->_pidFile = SY_ROOT . '/pidfile/' . SY_MODULE . $this->_port . '.pid';
        $this->_tipFile = SY_ROOT . '/tipfile/' . SY_MODULE . $this->_port . '.txt';
        Dir::create(SY_ROOT . '/tipfile/');
        if(is_dir($this->_tipFile)){
            exit('提示文件不能是文件夹' . PHP_EOL);
        } else if(!file_exists($this->_tipFile)){
            $tipFileObj = fopen($this->_tipFile, 'wb');
            if(is_bool($tipFileObj)){
                exit('创建或打开提示文件失败' . PHP_EOL);
            }
            fwrite($tipFileObj, '');
            fclose($tipFileObj);
        }
        $this->_syPack = new SyPack();

        //生成服务唯一标识
        self::$_serverToken = hash('crc32b', $this->_configs['server']['host'] . ':' . $this->_configs['server']['port']);
        $this->createUniqueToken();

        //设置日志目录
        Log::setPath(SY_LOG_PATH);
    }

    private function __clone() {
    }

    private function checkSystemEnv() {
        if(PHP_INT_SIZE < 8){
            exit('操作系统必须是64位' . PHP_EOL);
        }
        if(version_compare(PHP_VERSION, Server::VERSION_MIN_PHP, '<')){
            exit('PHP版本必须大于等于' . Server::VERSION_MIN_PHP . PHP_EOL);
        }
        if (!defined('SY_MODULE')) {
            exit('模块名称未定义' . PHP_EOL);
        }
        if (!defined('SY_TOKEN')) {
            exit('令牌未定义' . PHP_EOL);
        }
        if (!ctype_alnum(SY_TOKEN)) {
            exit('令牌不合法' . PHP_EOL);
        }
        if (strlen(SY_TOKEN) != 8) {
            exit('令牌不合法' . PHP_EOL);
        }
        if(!in_array(SY_ENV, Server::$totalEnvProject)){
            exit('环境类型不合法' . PHP_EOL);
        }

        $os = php_uname('s');
        if(!in_array($os, Server::$totalEnvSystem)){
            exit('操作系统不支持' . PHP_EOL);
        }

        //检查必要的扩展是否存在
        $extensionList = [
            'yac',
            'yaf',
            'PDO',
            'pcre',
            'pcntl',
            'redis',
            'yaconf',
            'swoole',
            'SeasLog',
            'msgpack',
        ];
        foreach ($extensionList as $extName) {
            if(!extension_loaded($extName)){
                exit('扩展' . $extName . '未加载' . PHP_EOL);
            }
        }

        if(version_compare(SWOOLE_VERSION, Server::VERSION_MIN_SWOOLE, '<')){
            exit('swoole版本必须大于等于' . Server::VERSION_MIN_SWOOLE . PHP_EOL);
        }
        if(version_compare(SEASLOG_VERSION, Server::VERSION_MIN_SEASLOG, '<')){
            exit('seaslog版本必须大于等于' . Server::VERSION_MIN_SEASLOG . PHP_EOL);
        }
        if(version_compare(YAC_VERSION, Server::VERSION_MIN_YAC, '<')){
            exit('yac版本必须大于等于' . Server::VERSION_MIN_YAC . PHP_EOL);
        }
        if(version_compare(\YAF\VERSION, Server::VERSION_MIN_YAF, '<')){
            exit('yaf版本必须大于等于' . Server::VERSION_MIN_YAF . PHP_EOL);
        }
    }

    private function createUniqueToken() {
        $execRes = Tool::execSystemCommand('ifconfig -a | awk \'{for(i=1;i<=NF;i++)if($i ~ "ether")print $(i+1);}\'');
        if($execRes['code'] > 0){
            exit($execRes['msg'] . PHP_EOL);
        }

        foreach ($execRes['data'] as $eMac) {
            $macAddress = trim($eMac);
            if(strlen($macAddress) == 17){
                self::$_uniqueToken = hash('crc32b', $macAddress . ':' . $this->_port);
                break;
            }
        }

        if(strlen(self::$_uniqueToken) == 0){
            exit('生成唯一码失败' . PHP_EOL);
        }
    }

    protected function addTaskBase(\swoole_server $server) {
        if(SY_SERVER_TYPE == Server::SERVER_TYPE_API_MODULE){
            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE,
                'task_params' => [],
            ]);
            $taskDataUser = $this->_syPack->packData();
            $this->_syPack->init();

            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $taskDataWx = $this->_syPack->packData();
            $this->_syPack->init();
        } else {
            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
                'task_module' => SY_MODULE,
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE,
                'task_params' => [],
            ]);
            $taskDataUser = $this->_syPack->packData();
            $this->_syPack->init();

            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
                'task_module' => SY_MODULE,
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $taskDataWx = $this->_syPack->packData();
            $this->_syPack->init();
        }

        $server->tick(Project::TIME_TASK_CLEAR_LOCAL_USER, function() use ($server, $taskDataUser) {
            $server->task($taskDataUser);
        });
        $server->tick(Project::TIME_TASK_CLEAR_LOCAL_WX, function() use ($server, $taskDataWx) {
            $server->task($taskDataWx);
        });
        $this->addTaskBaseTrait($server);
    }

    /**
     * @param \swoole_server $server
     * @param int $taskId
     * @param int $fromId
     * @param string $data
     * @return array|string
     */
    protected function handleTaskBase(\swoole_server $server,int $taskId,int $fromId,string $data) {
        $result = new Result();
        if(!$this->_syPack->unpackData($data)){
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '数据格式不合法');
            return $result->getJson();
        }

        RedisSingleton::getInstance()->reConnect();
        if(SY_DATABASE){
            MysqlSingleton::getInstance()->reConnect();
        }

        $command = $this->_syPack->getCommand();
        $commandData = $this->_syPack->getData();
        $this->_syPack->init();

        if(in_array($command, [SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ])){
            $taskCommand = Tool::getArrayVal($commandData, 'task_command', '');
            switch ($taskCommand) {
                case Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE:
                    $this->clearLocalUsers();
                    break;
                case Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE:
                    $this->clearWxCache();
                    break;
                default:
                    $taskData = [
                        'command' => $command,
                        'params' => $commandData,
                    ];
                    $traitRes = $this->handleTaskBaseTrait($server, $taskId, $fromId, $taskData);
                    if(strlen($traitRes) == 0){
                        return $taskData;
                    } else {
                        return $traitRes;
                    }
            }

            $result->setData([
                'result' => 'success',
            ]);
        } else {
            $result->setData([
                'result' => 'fail',
            ]);
        }

        return $result->getJson();
    }

    /**
     * 创建请求ID
     */
    protected function createReqId() {
        self::$_reqId = hash('md4', Tool::getNowTime() . Tool::createNonceStr(5));
    }

    /**
     * @return string
     */
    public static function getReqId() : string {
        return self::$_reqId;
    }

    /**
     * 检查请求限流
     * @throws \Exception\Swoole\ServerException
     */
    protected static function checkRequestCurrentLimit() {
        $nowHandlingNum = self::$_syServer->incr(self::$_serverToken, 'request_handling', 1);
        if($nowHandlingNum > SY_REQUEST_MAX_HANDLING){
            throw new ServerException('服务繁忙', ErrorCode::COMMON_SERVER_BUSY);
        }
    }

    /**
     * 记录耗时长的请求
     * @param string $uri 请求uri
     * @param string|array $data 请求数据
     */
    protected function reportLongTimeReq(string $uri, $data) {
        $handleTime = (int)((microtime(true) - self::$_reqStartTime) * 1000);
        self::$_reqStartTime = 0;
        if($handleTime > Project::TIME_EXPIRE_REQ_HANDLE){ //执行时间超过限制的请求记录到日志便于分析具体情况
            $content = 'handle req use time ' . $handleTime . ' ms,uri:' . $uri . ',data:';
            if(is_string($data)){
                $content .= $data;
            } else {
                $content .= Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
            }

            Log::warn($content);
        }
    }

    /**
     * 生成检查标识
     * @return string
     */
    protected function createCheckTag() : string {
        return self::$_serverToken . Tool::getNowTime() . Tool::createNonceStr(6);
    }

    /**
     * 发送请求健康检查任务
     * @param string $uri
     * @return string
     */
    protected function sendReqHealthCheckTask(string $uri) : string {
        $tag = $this->createCheckTag();
        self::$_syHealths->set($tag, [
            'tag' => $tag,
            'module' => SY_MODULE,
            'uri' => $uri,
        ]);
        $this->_server->after(Project::TIME_EXPIRE_REQ_HEALTH_CHECK, function () use ($tag) {
            $checkData = self::$_syHealths->get($tag);
            if($checkData !== false){
                self::$_syHealths->del($tag);
            }
        });

        return $tag;
    }

    /**
     * 检测请求URI
     * @param string $uri
     * @return array
     */
    protected function checkRequestUri(string $uri) : array {
        $nowUri = $uri;
        $checkRes = [
            'uri' => '',
            'error' => '',
        ];

        $uriRes = Tool::handleYafUri($nowUri);
        if(strlen($uriRes) == 0){
            $checkRes['uri'] = $nowUri;
        } else {
            $checkRes['error'] = $uriRes;
        }

        return $checkRes;
    }

    /**
     * 获取唯一数值
     * @return array
     */
    public static function getUniqueNum() : array {
        return [
            'token' => self::$_uniqueToken,
            'unique_num' => self::$_syServer->incr(self::$_serverToken, 'unique_num'),
        ];
    }

    /**
     * 获取预处理函数
     * @param string $uri
     * @param array $frameMap
     * @param array $projectMap
     * @return bool|string
     */
    protected function getPreProcessFunction(string $uri,array $frameMap,array $projectMap) {
        $funcName = '';
        if(strlen($uri) == 5){
            if (isset($frameMap[$uri])) {
                $funcName = $frameMap[$uri];
                if(strpos($funcName, 'preProcessFrame') !== 0){
                    $funcName = false;
                }
            } else if(isset($projectMap[$uri])){
                $funcName = $projectMap[$uri];
                if(strpos($funcName, 'preProcessProject') !== 0){
                    $funcName = false;
                }
            }
        }

        return $funcName;
    }

    /**
     * 基础启动服务
     * @param array $registerMap
     */
    protected function baseStart(array $registerMap) {
        $this->_server->set($this->_configs['swoole']);
        //绑定注册方法
        foreach ($registerMap as $eventName => $funcName) {
            $this->_server->on($eventName, [$this, $funcName]);
        }

        file_put_contents($this->_tipFile, '\e[1;36m start ' . SY_MODULE . ': \e[0m \e[1;31m \t[fail] \e[0m');
        //启动服务
        $this->_server->start();
    }

    /**
     * 开启服务
     */
    abstract public function start();

    /**
     * 帮助信息
     */
    public function help(){
        print_r('帮助信息' . PHP_EOL);
        print_r('-s 操作类型: restart-重启 stop-关闭 start-启动 kz-清理僵尸进程 startstatus-启动状态' . PHP_EOL);
        print_r('-n 项目名' . PHP_EOL);
        print_r('-module 模块名' . PHP_EOL);
        print_r('-port 端口,取值范围为1001-65535' . PHP_EOL);
    }

    /**
     * 关闭服务
     */
    public function stop(){
        if(is_file($this->_pidFile) && is_readable($this->_pidFile)){
            $pid = (int)file_get_contents($this->_pidFile);
        } else {
            $pid = 0;
        }

        $msg = ' \e[1;31m \t[fail]';
        if($pid > 0){
            if(\swoole_process::kill($pid)){
                $msg = ' \e[1;32m \t[success]';
            }
            file_put_contents($this->_pidFile, '');
        }
        system('echo -e "\e[1;36m stop ' . SY_MODULE . ': \e[0m' . $msg . ' \e[0m"');
        exit();
    }

    /**
     * 清理僵尸进程
     */
    public function killZombies(){
        //清除僵尸进程
        $commandZombies = 'ps -A -o pid,ppid,stat,cmd|grep ' . SY_MODULE . '|awk \'{if(($3 == "Z") || ($3 == "z")) print $1}\'';
        $execRes = Tool::execSystemCommand($commandZombies);
        if(($execRes['code'] == 0) && !empty($execRes['data'])){
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除worker中断进程
        $commandWorkers = 'ps -A -o pid,ppid,stat,cmd|grep ' . Server::PROCESS_TYPE_WORKER . SY_MODULE . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandWorkers);
        if(($execRes['code'] == 0) && !empty($execRes['data'])){
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除task中断进程
        $commandTasks = 'ps -A -o pid,ppid,stat,cmd|grep ' . Server::PROCESS_TYPE_TASK . SY_MODULE . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandTasks);
        if(($execRes['code'] == 0) && !empty($execRes['data'])){
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        $commandTip = 'echo -e "\e[1;36m kill ' . SY_MODULE . ' zombies: \e[0m \e[1;32m \t[success] \e[0m"';
        system($commandTip);
    }

    /**
     * 获取服务启动状态
     */
    public function getStartStatus(){
        $fileContent = file_get_contents($this->_tipFile);
        $command = 'echo -e "\e[1;31m ' . SY_MODULE . ' start status fail \e[0m"';
        if(is_string($fileContent)){
            if(strlen($fileContent) > 0){
                $command = 'echo -e "' . $fileContent . '"';
            }
            file_put_contents($this->_tipFile, '');
        }
        system($command);
        exit();
    }

    /**
     * 通过模块名称获取注册的服务信息
     * @param string $moduleName
     * @return array
     */
    public static function getServiceInfo(string $moduleName) {
        $serviceInfo = self::$_syServices->get($moduleName);
        return $serviceInfo === false ? [] : $serviceInfo;
    }

    /**
     * 获取服务配置信息
     * @param string $field 配置字段名称
     * @param null $default
     * @return mixed
     */
    public static function getServerConfig(string $field=null, $default=null) {
        if (is_null($field)) {
            $data = self::$_syServer->get(self::$_serverToken);
            return $data === false ? [] : $data;
        } else {
            $data = self::$_syServer->get(self::$_serverToken, $field);
            return $data === false ? $default : $data;
        }
    }

    protected function basicWorkStart(\swoole_server $server, $workerId){
        //设置错误和异常处理
        set_exception_handler('\SyError\ErrorHandler::handleException');
        set_error_handler('\SyError\ErrorHandler::handleError');
        //设置时区
        date_default_timezone_set('PRC');
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        //设置bc数学函数小数点保留位数
        $bcConfigs = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.bcmath');
        bcscale($bcConfigs['scale']);

        $this->_app = new Application(APP_PATH . '/conf/application.ini', SY_ENV);
        $this->_app->bootstrap()->getDispatcher()->returnResponse(true);
        $this->_app->bootstrap()->getDispatcher()->autoRender(false);

        if($workerId >= $server->setting['worker_num']){
            @cli_set_process_title(Server::PROCESS_TYPE_TASK . SY_MODULE . $this->_port);
        } else {
            @cli_set_process_title(Server::PROCESS_TYPE_WORKER . SY_MODULE . $this->_port);
        }

        if($workerId == 0){ //保证每一个服务只执行一次定时任务
            $modules = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules');
            foreach (Project::$totalModuleBase as $eModuleName) {
                $moduleData = Tool::getArrayVal($modules, $eModuleName, []);
                if (!empty($moduleData)) {
                    self::$_syServices->set($eModuleName, [
                        'module' => $eModuleName,
                        'host' => $moduleData['host'],
                        'port' => (string)$moduleData['port'],
                        'type' => $moduleData['type'],
                    ]);
                }
            }
        }
    }

    protected function basicWorkStop(\swoole_server $server,int $workId) {
        $errCode = $server->getLastError();
        if($errCode > 0){
            Log::error('swoole work stop,workId=' . $workId . ',errorCode=' . $errCode . ',errorMsg=' . print_r(error_get_last(), true));
        }
    }

    protected function basicWorkError(\swoole_server $server, $workId, $workPid, $exitCode){
        if($exitCode > 0){
            $msg = 'swoole work error. work_id=' . $workId . '|work_pid=' . $workPid . '|exit_code=' . $exitCode . '|err_msg=' . $server->getLastError();
            Log::error($msg);
        }
    }

    /**
     * 启动主进程服务
     * @param \swoole_server $server
     * @throws \Exception\Swoole\ServerException
     */
    public function onStart(\swoole_server $server) {
        @cli_set_process_title(Server::PROCESS_TYPE_MAIN . SY_MODULE . $this->_port);

        Dir::create(SY_ROOT . '/pidfile/');
        if (file_put_contents($this->_pidFile, $server->master_pid) === false) {
            Log::error('write ' . SY_MODULE . ' pid file error');
        }

        file_put_contents($this->_tipFile, '\e[1;36m start ' . SY_MODULE . ': \e[0m \e[1;32m \t[success] \e[0m');

        $config = Tool::getConfig('project.' . SY_ENV . SY_PROJECT);
        Dir::create($config['dir']['store']['image']);
        Dir::create($config['dir']['store']['music']);
        Dir::create($config['dir']['store']['resources']);
        Dir::create($config['dir']['store']['cache']);

        //为了防止定时任务出现重启服务的时候,导致重启期间(1-3s内)的定时任务无法处理,将定时器时间初始化为当前时间戳之前6秒
        $timerAdvanceTime = (int)Tool::getArrayVal($config, 'timer.time.advance', 6, true);
        $initTimerTime = time() - $timerAdvanceTime;
        self::$_syServer->set(self::$_serverToken, [
            'memory_usage' => memory_get_usage(),
            'timer_time' => $initTimerTime,
            'request_times' => 0,
            'request_handling' => 0,
            'host_local' => $this->_host,
            'storepath_image' => $config['dir']['store']['image'],
            'storepath_music' => $config['dir']['store']['music'],
            'storepath_resources' => $config['dir']['store']['resources'],
            'storepath_cache' => $config['dir']['store']['cache'],
            'token_etime' => time() + 7200,
            'unique_num' => 100000000,
        ]);

        //设置唯一ID自增基数
        $num = (int)CacheSimpleFactory::getRedisInstance()->incr(Project::DATA_KEY_CACHE_UNIQUE_ID);
        if($num < 100000000){
            $randomNum = random_int(100000000, 150000000);
            if(!CacheSimpleFactory::getRedisInstance()->set(Project::DATA_KEY_CACHE_UNIQUE_ID, $randomNum)){
                throw new ServerException('设置唯一ID自增基数出错', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
            };
        } else if($num > 500000000){
            $reduceNum = $num - 100000000 - ($num % 100000000);
            CacheSimpleFactory::getRedisInstance()->decrBy(Project::DATA_KEY_CACHE_UNIQUE_ID, $reduceNum);
        }
    }

    /**
     * 启动管理进程
     * @param \swoole_server $server
     */
    public function onManagerStart(\swoole_server $server){
        @cli_set_process_title(Server::PROCESS_TYPE_MANAGER . SY_MODULE . $this->_port);
    }

    /**
     * 关闭服务
     * @param \swoole_server $server
     */
    public function onShutdown(\swoole_server $server){
    }

    /**
     * 任务完成
     * @param \swoole_server $server
     * @param int $taskId
     * @param string $data
     */
    public function onFinish(\swoole_server $server, $taskId,string $data){
        $dataArr = Tool::jsonDecode($data);
        if ((!is_array($dataArr)) || ($dataArr['code'] > 0)) {
            Log::info('handle task fail with msg:' . $data);
        }
    }

    /**
     * 关闭连接
     * @param \swoole_server $server
     * @param int $fd 连接的文件描述符
     * @param int $reactorId reactor线程ID,$reactorId<0:服务器端关闭 $reactorId>0:客户端关闭
     */
    public function onClose(\swoole_server $server,int $fd,int $reactorId) {
    }

    /**
     * 启动工作进程
     * @param \swoole_server $server
     * @param int $workerId 进程编号
     */
    abstract public function onWorkerStart(\swoole_server $server, $workerId);
    /**
     * 退出工作进程
     * @param \swoole_server $server
     * @param int $workerId
     * @return mixed
     */
    abstract public function onWorkerStop(\swoole_server $server, int $workerId);
    /**
     * 工作进程错误处理
     * @param \swoole_server $server
     * @param int $workId 进程编号
     * @param int $workPid 进程ID
     * @param int $exitCode 退出状态码
     */
    abstract public function onWorkerError(\swoole_server $server, $workId, $workPid, $exitCode);
    /**
     * 处理任务
     * @param \swoole_server $server
     * @param int $taskId
     * @param int $fromId
     * @param string $data
     * @return string
     */
    abstract public function onTask(\swoole_server $server,int $taskId,int $fromId,string $data);
}
