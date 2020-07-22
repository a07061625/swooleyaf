<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:32
 */
namespace SyServer;

use DesignPatterns\Singletons\MysqlSingleton;
use Swoole\Coroutine;
use Swoole\Process;
use Swoole\Runtime;
use Swoole\Server;
use Swoole\Timer;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\RedisSingleton;
use SyException\Swoole\ServerException;
use SyException\Validator\ValidatorException;
use SyLog\Log;
use SyResponse\Result;
use SyTool\Dir;
use SyTool\SyPack;
use SyTool\Tool;
use SyTrait\Server\FrameBaseTrait;
use SyTrait\Server\ProjectBaseTrait2;

abstract class BaseServer2
{
    use FrameBaseTrait;
    use ProjectBaseTrait2;

    /**
     * 请求服务对象
     * @var \Swoole\WebSocket\Server|\Swoole\Server
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
     * @var \yii\web\Application
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
     * @var \SyTool\SyPack
     */
    protected $_syPack = null;
    /**
     * 提示文件
     * @var string
     */
    protected $_tipFile = '';
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
    public function __construct(int $port)
    {
        if (($port <= SyInner::ENV_PORT_MIN) || ($port > SyInner::ENV_PORT_MAX)) {
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
        $this->_configs['swoole']['log_level'] = SWOOLE_LOG_INFO;
        //开启TCP快速握手特性,可以提升TCP短连接的响应速度
        $this->_configs['swoole']['tcp_fastopen'] = true;
        //启用异步安全重启特性,Worker进程会等待异步事件完成后再退出
        $this->_configs['swoole']['reload_async'] = true;
        //进程最大等待时间,单位为秒
        $this->_configs['swoole']['max_wait_time'] = 60;
        //dispatch_mode=1或3后,系统无法保证onConnect/onReceive/onClose的顺序,因此可能会有一些请求数据在连接关闭后才能到达Worker进程
        //设置为false表示无论连接是否关闭Worker进程都会处理数据请求
        $this->_configs['swoole']['discard_timeout_request'] = false;
        //设置请求数据尺寸
        $this->_configs['swoole']['open_length_check'] = true;
        $this->_configs['swoole']['package_max_length'] = Project::SIZE_SERVER_PACKAGE_MAX;
        $this->_configs['swoole']['socket_buffer_size'] = Project::SIZE_CLIENT_SOCKET_BUFFER;
        $this->_configs['swoole']['buffer_output_size'] = Project::SIZE_CLIENT_BUFFER_OUTPUT;
        //设置线程数量
        $execRes = Tool::execSystemCommand('cat /proc/cpuinfo | grep "processor" | wc -l');
        $this->_configs['swoole']['reactor_num'] = (int)(2 * $execRes['data'][0]);

        $taskNum = isset($this->_configs['swoole']['task_worker_num']) ? (int)$this->_configs['swoole']['task_worker_num'] : 0;
        if ($taskNum < 2) {
            exit('Task进程的数量必须大于等于2' . PHP_EOL);
        }
        $this->_taskNum = $taskNum;
        $this->_taskMaxId = $taskNum - 1;
        $this->_host = $this->_configs['server']['host'];
        $this->_port = $this->_configs['server']['port'];
        $this->_pidFile = SY_ROOT . '/pidfile/' . SY_MODULE . $this->_port . '.pid';
        $this->_tipFile = SY_ROOT . '/tipfile/' . SY_MODULE . $this->_port . '.txt';
        Dir::create(SY_ROOT . '/tipfile/');
        if (is_dir($this->_tipFile)) {
            exit('提示文件不能是文件夹' . PHP_EOL);
        } elseif (!file_exists($this->_tipFile)) {
            $tipFileObj = fopen($this->_tipFile, 'wb');
            if (is_bool($tipFileObj)) {
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

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public static function getReqId() : string
    {
        if (isset($_SERVER['SYREQ_ID'])) {
            return $_SERVER['SYREQ_ID'];
        }
        $reqId = hash('md4', Tool::getNowTime() . Tool::createNonceStr(8));
        $_SERVER['SYREQ_ID'] = $reqId;
        return $reqId;
    }

    /**
     * 获取唯一数值
     * @return array
     */
    public static function getUniqueNum() : array
    {
        return [
            'token' => self::$_uniqueToken,
            'unique_num' => self::$_syServer->incr(self::$_serverToken, 'unique_num'),
        ];
    }

    /**
     * 开启服务
     */
    abstract public function start();

    /**
     * 帮助信息
     */
    public function help()
    {
        print_r('帮助信息' . PHP_EOL);
        print_r('-s 操作类型: restart-重启 stop-关闭 start-启动 kz-清理僵尸进程 startstatus-启动状态' . PHP_EOL);
        print_r('-module 模块名' . PHP_EOL);
        print_r('-port 端口,取值范围为1024-65535' . PHP_EOL);
    }

    /**
     * 关闭服务
     */
    public function stop()
    {
        if (is_file($this->_pidFile) && is_readable($this->_pidFile)) {
            $pid = (int)file_get_contents($this->_pidFile);
        } else {
            $pid = 0;
        }

        $msg = ' \t [fail]';
        if ($pid > 0) {
            if (Process::kill($pid, SIGKILL)) {
                $msg = ' \t [success]';
            }
            file_put_contents($this->_pidFile, '');
        }
        system('echo "stop ' . SY_MODULE . ':' . $msg . '"');
        exit();
    }

    /**
     * 清理僵尸进程
     */
    public function killZombies()
    {
        //清除僵尸进程
        $commandZombies = 'ps -A -o pid,ppid,stat,cmd|grep ' . SY_MODULE . '|awk \'{if(($3 == "Z") || ($3 == "z")) print $1}\'';
        $execRes = Tool::execSystemCommand($commandZombies);
        if (($execRes['code'] == 0) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除worker中断进程
        $commandWorkers = 'ps -A -o pid,ppid,stat,cmd|grep ' . SyInner::PROCESS_TYPE_WORKER . SY_MODULE . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandWorkers);
        if (($execRes['code'] == 0) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除task中断进程
        $commandTasks = 'ps -A -o pid,ppid,stat,cmd|grep ' . SyInner::PROCESS_TYPE_TASK . SY_MODULE . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandTasks);
        if (($execRes['code'] == 0) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        $commandTip = 'echo "kill ' . SY_MODULE . ' zombies: \t [success]"';
        system($commandTip);
    }

    /**
     * 获取服务启动状态
     */
    public function getStartStatus()
    {
        $fileContent = file_get_contents($this->_tipFile);
        $command = 'echo "' . SY_MODULE . ' start status fail"';
        if (is_string($fileContent)) {
            if (strlen($fileContent) > 0) {
                $command = 'echo "' . $fileContent . '"';
            }
            file_put_contents($this->_tipFile, '');
        }
        system($command);
        exit();
    }

    /**
     * 启动工作进程
     * @param \Swoole\Server $server
     * @param int $workerId 进程编号
     */
    public function onWorkerStart(Server $server, $workerId)
    {
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

        $this->initApp();

        if ($workerId >= $server->setting['worker_num']) {
            @cli_set_process_title(SyInner::PROCESS_TYPE_TASK . SY_MODULE . $this->_port);
        } else {
            @cli_set_process_title(SyInner::PROCESS_TYPE_WORKER . SY_MODULE . $this->_port);
        }

        if ($workerId == 0) { //保证每一个服务只执行一次定时任务
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

    /**
     * 启动管理进程
     * @param \Swoole\Server $server
     */
    public function onManagerStart(Server $server)
    {
        @cli_set_process_title(SyInner::PROCESS_TYPE_MANAGER . SY_MODULE . $this->_port);
    }

    /**
     * 关闭服务
     * @param \Swoole\Server $server
     */
    public function onShutdown(Server $server)
    {
    }

    /**
     * 任务完成
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param string $data
     */
    public function onFinish(Server $server, $taskId, string $data)
    {
    }

    /**
     * 关闭连接
     * @param \Swoole\Server $server
     * @param int $fd 连接的文件描述符
     * @param int $reactorId reactor线程ID,$reactorId<0:服务器端关闭 $reactorId>0:客户端关闭
     */
    public function onClose(Server $server, int $fd, int $reactorId)
    {
    }

    /**
     * 工作进程退出
     * @param \Swoole\Server $server
     * @param int $workerId 工作进程ID
     */
    public function onWorkerExit(Server $server, int $workerId)
    {
        $fdList = $server->connections;
        foreach ($fdList as $eFd) {
            if ($server->exist($eFd)) {
                $server->close($eFd);
            }
        }

        if (version_compare(SWOOLE_VERSION, '4.4.0', '>=')) {
            Timer::clearAll();
        }
    }

    /**
     * 启动主进程服务
     * @param \Swoole\Server $server
     * @throws \SyException\Swoole\ServerException
     */
    abstract public function onStart(Server $server);
    /**
     * 退出工作进程
     * @param \Swoole\Server $server
     * @param int $workerId
     * @return mixed
     */
    abstract public function onWorkerStop(Server $server, int $workerId);
    /**
     * 工作进程错误处理
     * @param \Swoole\Server $server
     * @param int $workId 进程编号
     * @param int $workPid 进程ID
     * @param int $exitCode 退出状态码
     */
    abstract public function onWorkerError(Server $server, $workId, $workPid, $exitCode);
    /**
     * 处理任务
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param string $data
     * @return string
     */
    abstract public function onTask(Server $server, int $taskId, int $fromId, string $data);

    protected function addTaskBase(Server $server)
    {
        if (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_MODULE) {
            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $taskDataWx = $this->_syPack->packData();
            $this->_syPack->init();
        } else {
            $this->_syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
                'task_module' => SY_MODULE,
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $taskDataWx = $this->_syPack->packData();
            $this->_syPack->init();
        }

        $server->tick(Project::TIME_TASK_CLEAR_LOCAL_WX, function () use ($server, $taskDataWx) {
            $server->task($taskDataWx);
        });
        $this->addTaskBaseTrait($server);
    }

    /**
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param string $data
     * @return array|string
     */
    protected function handleTaskBase(Server $server, int $taskId, int $fromId, string $data)
    {
        if (!$this->_syPack->unpackData($data)) {
            return '数据格式不合法';
        }

        RedisSingleton::getInstance()->reConnect();
        if (defined('SY_DATABASE') && SY_DATABASE) {
            MysqlSingleton::getInstance()->reConnect();
        }

        $command = $this->_syPack->getCommand();
        $commandData = $this->_syPack->getData();
        $this->_syPack->init();

        if (in_array($command, [SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ], true)) {
            $taskCommand = Tool::getArrayVal($commandData, 'task_command', '');
            switch ($taskCommand) {
                case Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE:
                    break;
                default:
                    $taskData = [
                        'command' => $command,
                        'params' => $commandData,
                    ];
                    $traitRes = $this->handleTaskBaseTrait($server, $taskId, $fromId, $taskData);
                    if (strlen($traitRes) == 0) {
                        return $taskData;
                    } else {
                        return $traitRes;
                    }
            }
        }

        return '';
    }

    /**
     * 检查请求限流
     * @throws \SyException\Swoole\ServerException
     */
    protected static function checkRequestCurrentLimit()
    {
        $nowHandlingNum = self::$_syServer->incr(self::$_serverToken, 'request_handling', 1);
        if ($nowHandlingNum > SY_REQUEST_MAX_HANDLING) {
            throw new ServerException('服务繁忙', ErrorCode::COMMON_SERVER_BUSY);
        }
    }

    /**
     * 记录耗时长的请求
     * @param string $uri 请求uri
     * @param string|array $data 请求数据
     * @param int $limitTime 限制时间,单位为毫秒
     */
    protected function reportLongTimeReq(string $uri, $data, int $limitTime)
    {
        $handleTime = (int)((microtime(true) - self::$_reqStartTime) * 1000);
        self::$_reqStartTime = 0;
        if ($handleTime > $limitTime) { //执行时间超过限制的请求记录到日志便于分析具体情况
            $content = 'handle req use time ' . $handleTime . ' ms,uri:' . $uri . ',data:';
            if (is_string($data)) {
                $content .= $data;
            } else {
                $content .= Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
            }

            Log::warn($content);
        }
    }

    /**
     * 检测请求URI
     * @param string $uri
     * @return array
     */
    protected function checkRequestUri(string $uri) : array
    {
        $nowUri = $uri;
        $checkRes = [
            'uri' => '',
            'error' => '',
        ];

        $uriRes = Tool::handleYafUri($nowUri);
        if (strlen($uriRes) == 0) {
            $checkRes['uri'] = $nowUri;
        } else {
            $errRes = new Result();
            $errRes->setCodeMsg(ErrorCode::COMMON_ROUTE_URI_FORMAT_ERROR, $uriRes);
            $checkRes['error'] = $errRes->getJson();
            unset($errRes);
        }

        return $checkRes;
    }

    /**
     * 获取预处理函数
     * @param string $uri
     * @param array $frameMap
     * @param array $projectMap
     * @return bool|string
     */
    protected function getPreProcessFunction(string $uri, array $frameMap, array $projectMap)
    {
        $funcName = '';
        if (strlen($uri) == 5) {
            $needTag = substr($uri, 1);
            $funcPrefix = '';
            if (ctype_digit($needTag)) {
                $funcName = $frameMap[$uri] ?? '';
                $funcPrefix = 'preProcessFrame';
            } elseif (ctype_alnum($needTag)) {
                $funcName = $projectMap[$uri] ?? '';
                $funcPrefix = 'preProcessProject';
            }
            if ((strlen($funcName) > 0) && (strpos($funcName, $funcPrefix) !== 0)) {
                $funcName = false;
            }
        }

        return $funcName;
    }

    /**
     * 基础启动服务
     * @param array $registerMap
     */
    protected function baseStart(array $registerMap)
    {
        $this->_server->set($this->_configs['swoole']);
        //绑定注册方法
        foreach ($registerMap as $eventName => $funcName) {
            $this->_server->on($eventName, [$this, $funcName]);
        }

        file_put_contents($this->_tipFile, 'start ' . SY_MODULE . ': \t [fail]');
        //启动服务
        $this->_server->start();
    }

    protected function basicStart(Server $server)
    {
        @cli_set_process_title(SyInner::PROCESS_TYPE_MAIN . SY_MODULE . $this->_port);

        Dir::create(SY_ROOT . '/pidfile/');
        if (file_put_contents($this->_pidFile, $server->master_pid) === false) {
            Log::error('write ' . SY_MODULE . ' pid file error');
        }

        file_put_contents($this->_tipFile, 'start ' . SY_MODULE . ': \t [success]');

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
        if ($num < 100000000) {
            $randomNum = random_int(100000000, 150000000);
            if (!CacheSimpleFactory::getRedisInstance()->set(Project::DATA_KEY_CACHE_UNIQUE_ID, $randomNum)) {
                throw new ServerException('设置唯一ID自增基数出错', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
            }
        } elseif ($num > 500000000) {
            $reduceNum = $num - 100000000 - ($num % 100000000);
            CacheSimpleFactory::getRedisInstance()->decrBy(Project::DATA_KEY_CACHE_UNIQUE_ID, $reduceNum);
        }

        Runtime::enableCoroutine(true);
        $coroutineConfigs = Tool::getArrayVal($this->_configs, 'server.coroutine', [], true);
        if (!empty($coroutineConfigs)) {
            Coroutine::set($coroutineConfigs);
        }
    }

    protected function basicWorkStop(Server $server, int $workId)
    {
        //热加载
        $server->reload();
        
        $errCode = $server->getLastError();
        if ($errCode > 0) {
            Log::error('swoole work stop,workId=' . $workId . ',errorCode=' . $errCode . ',errorMsg=' . print_r(error_get_last(), true));
        }
    }

    protected function basicWorkError(Server $server, $workId, $workPid, $exitCode)
    {
        if ($exitCode > 0) {
            $msg = 'swoole work error. work_id=' . $workId . '|work_pid=' . $workPid . '|exit_code=' . $exitCode . '|err_msg=' . $server->getLastError();
            Log::error($msg);
        }
    }

    protected function handleReqExceptionByFrame(\Exception $e)
    {
        if (!($e instanceof ValidatorException)) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
        }

        $error = new Result();
        if (is_numeric($e->getCode())) {
            $error->setCodeMsg((int)$e->getCode(), $e->getMessage());
        } else {
            $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务出错');
        }

        return $error;
    }

    private function checkSystemEnv()
    {
        if (PHP_INT_SIZE < 8) {
            exit('操作系统必须是64位' . PHP_EOL);
        }
        if (version_compare(PHP_VERSION, SyInner::VERSION_MIN_PHP, '<')) {
            exit('PHP版本必须大于等于' . SyInner::VERSION_MIN_PHP . PHP_EOL);
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
        if (!in_array(SY_ENV, SyInner::$totalEnvProject, true)) {
            exit('环境类型不合法' . PHP_EOL);
        }

        $os = php_uname('s');
        if (!in_array($os, SyInner::$totalEnvSystem, true)) {
            exit('操作系统不支持' . PHP_EOL);
        }

        //检查必要的扩展是否存在
        $extensionList = [
            'PDO',
            'pcre',
            'pcntl',
            'redis',
            'yaconf',
            'swoole',
            'SeasLog',
        ];
        foreach ($extensionList as $extName) {
            if (!extension_loaded($extName)) {
                exit('扩展' . $extName . '未加载' . PHP_EOL);
            }
        }

        if (version_compare(SWOOLE_VERSION, SyInner::VERSION_MIN_SWOOLE, '<')) {
            exit('swoole版本必须大于等于' . SyInner::VERSION_MIN_SWOOLE . PHP_EOL);
        }
        if (version_compare(SEASLOG_VERSION, SyInner::VERSION_MIN_SEASLOG, '<')) {
            exit('seaslog版本必须大于等于' . SyInner::VERSION_MIN_SEASLOG . PHP_EOL);
        }
    }

    private function createUniqueToken()
    {
        $execRes = Tool::execSystemCommand('ifconfig -a | awk \'{for(i=1;i<=NF;i++)if($i ~ "HWaddr")print $(i+1);}\'');
        if ($execRes['code'] > 0) {
            exit($execRes['msg'] . PHP_EOL);
        }

        foreach ($execRes['data'] as $eMac) {
            $macAddress = trim($eMac);
            if (strlen($macAddress) == 17) {
                self::$_uniqueToken = hash('crc32b', $macAddress . ':' . $this->_port);
                break;
            }
        }

        if (strlen(self::$_uniqueToken) == 0) {
            exit('生成唯一码失败' . PHP_EOL);
        }
    }

    /**
     * 设置服务端类型
     * @param array $allowTypes
     */
    protected function setServerType(array $allowTypes)
    {
        $projectLength = strlen(SY_PROJECT);
        $serverType = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules.' . substr(SY_MODULE, $projectLength) . '.type');
        if (!in_array($serverType, $allowTypes, true)) {
            exit('服务端类型不支持' . PHP_EOL);
        }
        define('SY_SERVER_TYPE', $serverType);

        if ($serverType == SyInner::SERVER_TYPE_FRONT_GATE) {
            $this->_configs['server']['cachenum']['wx'] = 1;
        } else {
            $this->_configs['server']['cachenum']['wx'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.wx', 0, true);
        }
    }
}
