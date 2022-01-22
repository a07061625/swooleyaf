<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:32
 */

namespace SyServer;

use DesignPatterns\Factories\CacheSimpleFactory;
use DesignPatterns\Singletons\MemCacheSingleton;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use Response\Result;
use Swoole\Coroutine;
use Swoole\Process;
use Swoole\Runtime;
use Swoole\Server;
use Swoole\Timer;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyEventTask\TaskContainer;
use SyException\Swoole\ServerException;
use SyException\Validator\ValidatorException;
use SyLog\Log;
use SyServerRegister\Nginx\Http;
use SyTool\Dir;
use SyTool\SyPack;
use SyTool\Tool;
use SyTrait\Server\FrameBaseTrait;
use SyTrait\Server\ProjectBaseTrait;

abstract class BaseServer
{
    use FrameBaseTrait;
    use ProjectBaseTrait;

    /**
     * 请求服务对象
     *
     * @var \Swoole\Server|\Swoole\WebSocket\Server
     */
    protected $_server;
    /**
     * 请求域名
     *
     * @var string
     */
    protected $_host = '';
    /**
     * 请求端口
     *
     * @var int
     */
    protected $_port = 0;
    /**
     * task进程数量
     *
     * @var int
     */
    protected $_taskNum = 0;
    /**
     * 最大task进程ID号
     *
     * @var int
     */
    protected $_taskMaxId = -1;
    /**
     * pid文件
     *
     * @var string
     */
    protected $_pidFile = '';
    /**
     * 配置数组
     *
     * @var array
     */
    protected $_configs = [];
    /**
     * @var \SyTool\SyPack
     */
    protected $_syPack;
    /**
     * 提示文件
     *
     * @var string
     */
    protected $_tipFile = '';
    /**
     * @var \SyEventTask\TaskContainer
     */
    protected $_taskEventContainer;
    /**
     * 请求开始毫秒级时间戳
     *
     * @var float
     */
    protected static $_reqStartTime = 0.0;
    /**
     * 服务token码,用于标识不同的服务,每个服务的token不一样
     *
     * @var string
     */
    protected static $_serverToken = '';
    /**
     * 唯一码,作为服务端的唯一标识
     *
     * @var string
     */
    protected static $_uniqueToken = '';

    /**
     * BaseServer constructor.
     *
     * @param int $port 端口
     */
    public function __construct(int $port)
    {
        if (($port <= SyInner::ENV_PORT_MIN) || ($port > SyInner::ENV_PORT_MAX)) {
            exit('端口不合法' . PHP_EOL);
        }
        $this->checkSystemEnv();
        $this->_configs = Tool::getConfig('syserver.' . SY_ENV . SY_MODULE);

        \define('SY_SERVER_IP', $this->_configs['server']['host']);
        \define('SY_REQUEST_MAX_HANDLING', (int)$this->_configs['server']['request']['maxnum']['handling']);

        //获取当前操作系统的用户
        $execUser = Tool::execSystemCommand('whoami');
        $systemUser = $execUser['data'][0];
        \define('SY_SYSTEM_USER', $systemUser);

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

        $taskNum = (int)($this->_configs['swoole']['task_worker_num'] ?? 0);
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
        }
        if (!file_exists($this->_tipFile)) {
            $tipFileObj = fopen($this->_tipFile, 'w');
            if (\is_bool($tipFileObj)) {
                exit('创建或打开提示文件失败' . PHP_EOL);
            }
            fwrite($tipFileObj, '');
            fclose($tipFileObj);
        }
        $this->_syPack = new SyPack();
        $this->_taskEventContainer = new TaskContainer();

        //生成服务唯一标识
        $tokenStr = $this->_configs['server']['host'] . ':' . $this->_configs['server']['port'];
        self::$_serverToken = hash('crc32b', $tokenStr);
        $this->createUniqueToken();

        //设置日志目录
        Log::setPath(SY_LOG_PATH);
    }

    private function __clone()
    {
    }

    public function getHost(): string
    {
        return $this->_host;
    }

    public function getPort(): int
    {
        return $this->_port;
    }

    public static function getReqId(): string
    {
        $reqId = Tool::getArrayVal($_SERVER, Project::DATA_KEY_REQUEST_ID_SERVER, '');
        if (ctype_alnum($reqId)) {
            return $reqId;
        }

        $reqId = Tool::getArrayVal($_SERVER, 'HTTP_' . Project::DATA_KEY_REQUEST_ID_HEADER, '');
        if (!ctype_alnum($reqId)) {
            $reqId = hash('md4', Tool::getNowTime() . Tool::createNonceStr(8));
        }
        $_SERVER[Project::DATA_KEY_REQUEST_ID_SERVER] = $reqId;

        return $reqId;
    }

    /**
     * 获取唯一数值
     */
    public static function getUniqueNum(): array
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
        print_r('-n 项目名' . PHP_EOL);
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

        $msg = ' \e[1;31m \t[fail]';
        $stopStatus = false;
        if ($pid > 0) {
            if (Process::kill($pid, SIGKILL)) {
                $msg = ' \e[1;32m \t[success]';
                $stopStatus = true;
            }
            file_put_contents($this->_pidFile, '');
        }
        system('echo -e "\e[1;36m stop ' . SY_MODULE . ': \e[0m' . $msg . ' \e[0m"');

        if ($stopStatus && (SY_MODULE == Project::MODULE_NAME_API)) {
            $registerRes = [];
            $registerType = trim(Tool::getClientOption('-rt', false, ''));
            if (SyInner::SERVER_REGISTER_TYPE_NGINX == $registerType) {
                $register = new Http();
                $register->setHost($this->_host);
                $register->setPort($this->_port);
                $registerRes = $register->operatorServer('remove');
            }

            if (!empty($registerRes)) {
                if (0 == $registerRes['code']) {
                    $tipStr = 'echo -e "\e[1;32m ' . $registerRes['data'] . ' \e[0m"';
                } else {
                    $tipStr = 'echo -e "\e[1;31m ' . $registerRes['msg'] . ' \e[0m"';
                }
                system($tipStr);
            }
        }
        exit();
    }

    /**
     * 清理僵尸进程
     */
    public function killZombies()
    {
        //清除僵尸进程
        $commandZombies = 'ps -A -o pid,ppid,stat,cmd|grep '
                          . SY_MODULE
                          . '|awk \'{if(($3 == "Z") || ($3 == "z")) print $1}\'';
        $execRes = Tool::execSystemCommand($commandZombies);
        if ((0 == $execRes['code']) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除worker中断进程
        $commandWorkers = 'ps -A -o pid,ppid,stat,cmd|grep '
                          . SyInner::PROCESS_TYPE_WORKER . SY_MODULE
                          . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandWorkers);
        if ((0 == $execRes['code']) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        //清除task中断进程
        $commandTasks = 'ps -A -o pid,ppid,stat,cmd|grep '
                        . SyInner::PROCESS_TYPE_TASK . SY_MODULE
                        . '|awk \'{if($2 == "1") print $1}\'';
        $execRes = Tool::execSystemCommand($commandTasks);
        if ((0 == $execRes['code']) && !empty($execRes['data'])) {
            system('kill -9 ' . implode(' ', $execRes['data']));
        }

        $commandTip = 'echo -e "\e[1;36m kill ' . SY_MODULE . ' zombies: \e[0m \e[1;32m \t[success] \e[0m"';
        system($commandTip);
    }

    /**
     * 获取服务启动状态
     */
    public function getStartStatus()
    {
        $fileContent = file_get_contents($this->_tipFile);
        $startIndex = false;
        $command = 'echo -e "\e[1;31m ' . SY_MODULE . ' start status fail \e[0m"';
        if (\is_string($fileContent)) {
            if (\strlen($fileContent) > 0) {
                $startIndex = strpos($fileContent, 'success');
                $command = 'echo -e "' . $fileContent . '"';
            }
            file_put_contents($this->_tipFile, '');
        }
        system($command);

        if ((\is_int($startIndex)) && (SY_MODULE == Project::MODULE_NAME_API)) {
            $registerRes = [];
            $registerType = trim(Tool::getClientOption('-rt', false, ''));
            if (SyInner::SERVER_REGISTER_TYPE_NGINX == $registerType) {
                $register = new Http();
                $register->setHost($this->_host);
                $register->setPort($this->_port);
                $registerRes = $register->operatorServer('add');
            }

            if (!empty($registerRes)) {
                if (0 == $registerRes['code']) {
                    $tipStr = 'echo -e "\e[1;32m ' . $registerRes['data'] . ' \e[0m"';
                } else {
                    $tipStr = 'echo -e "\e[1;31m ' . $registerRes['msg'] . ' \e[0m"';
                }
                system($tipStr);
            }
        }
        exit();
    }

    /**
     * 启动主进程服务
     *
     * @param \Swoole\Server $server 服务进程
     *
     * @throws \SyException\Common\CheckException
     * @throws \SyException\Swoole\ServerException
     */
    public function onStart(Server $server)
    {
        $this->basicStart($server);

        //添加定时任务事件
        $registryMap = $this->_taskEventContainer->getRegistryMap();
        foreach ($registryMap as $tag => $val) {
            $task = $this->_taskEventContainer->getObj($tag);
            if (null === $task) {
                continue;
            }

            $intervalTime = $task->getIntervalTime();
            if (($intervalTime < 1000) || ($intervalTime > 86400000)) {
                continue;
            }

            $supportModules = $task->getSupportModules();
            if ((!empty($supportModules)) && (!isset($supportModules[SY_MODULE]))) {
                continue;
            }

            $supportServerTypes = $task->getSupportServerTypes();
            if ((!empty($supportServerTypes)) && (!isset($supportServerTypes[SY_SERVER_TYPE]))) {
                continue;
            }

            $packData = [
                'task_command' => $tag,
                'task_params' => $task->getData(),
            ];
            if (SY_SERVER_TYPE == SyInner::SERVER_TYPE_API_MODULE) {
                $command = SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ;
            } else {
                $command = SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ;
                $packData['task_module'] = SY_MODULE;
            }

            $this->_syPack->setCommandAndData($command, $packData);
            $tickData = $this->_syPack->packData();
            $this->_syPack->init();

            $server->tick($intervalTime, function () use ($server, $tickData) {
                $server->task($tickData);
            });
        }
    }

    /**
     * 启动工作进程
     *
     * @param \Swoole\Server $server   服务进程
     * @param int            $workerId 进程编号
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

        if (0 == $workerId) { //保证每一个服务只执行一次定时任务
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
     *
     * @param \Swoole\Server $server 服务进程
     */
    public function onManagerStart(Server $server)
    {
        @cli_set_process_title(SyInner::PROCESS_TYPE_MANAGER . SY_MODULE . $this->_port);
    }

    /**
     * 关闭服务
     *
     * @param \Swoole\Server $server 服务进程
     */
    public function onShutdown(Server $server)
    {
    }

    /**
     * 任务完成
     *
     * @param \Swoole\Server $server 服务进程
     * @param int            $taskId
     */
    public function onFinish(Server $server, $taskId, string $data)
    {
    }

    /**
     * 工作进程退出
     *
     * @param \Swoole\Server $server   服务进程
     * @param int            $workerId 工作进程ID
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
     * 处理任务
     *
     * @param \Swoole\Server $server 服务进程
     * @param int            $taskId 任务ID
     * @param int            $fromId 来源ID
     * @param string         $data   任务数据
     *
     * @throws \SyException\Mysql\MysqlException
     */
    public function onTask(Server $server, int $taskId, int $fromId, string $data)
    {
        if (!$this->_syPack->unpackData($data)) {
            Log::warn('定时任务数据格式不合法,源数据为: ' . $data);

            return;
        }

        RedisSingleton::getInstance()->reConnect();
        if (SY_MEMCACHE) {
            MemCacheSingleton::getInstance()->reConnect();
        }
        if (SY_DATABASE) {
            MysqlSingleton::getInstance()->reConnect();
        }

        $command = $this->_syPack->getCommand();
        $commandData = $this->_syPack->getData();
        $this->_syPack->init();

        if (\in_array($command, [
            SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ,
            SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ,
        ], true)) {
            $taskCommand = Tool::getArrayVal($commandData, 'task_command', '');
            $taskParams = Tool::getArrayVal($commandData, 'task_params', []);
            $task = $this->_taskEventContainer->getObj($taskCommand);
            $task->handle($taskParams);
        }
    }

    /**
     * 退出工作进程
     *
     * @param \Swoole\Server $server   服务进程
     * @param int            $workerId 进程ID
     *
     * @return mixed
     */
    abstract public function onWorkerStop(Server $server, int $workerId);

    /**
     * 工作进程错误处理
     *
     * @param \Swoole\Server $server   服务进程
     * @param int            $workId   进程编号
     * @param int            $workPid  进程ID
     * @param int            $exitCode 退出状态码
     */
    abstract public function onWorkerError(Server $server, $workId, $workPid, $exitCode);

    /**
     * 检查请求限流
     *
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
     *
     * @param string       $uri       请求uri
     * @param array|string $data      请求数据
     * @param int          $limitTime 限制时间,单位为毫秒
     */
    protected function reportLongTimeReq(string $uri, $data, int $limitTime)
    {
        $handleTime = (int)((microtime(true) - self::$_reqStartTime) * 1000);
        self::$_reqStartTime = 0;
        if ($handleTime > $limitTime) { //执行时间超过限制的请求记录到日志便于分析具体情况
            $content = 'handle req use time ' . $handleTime . ' ms,uri:' . $uri . ',data:';
            if (\is_string($data)) {
                $content .= $data;
            } else {
                $content .= Tool::jsonEncode($data, JSON_UNESCAPED_UNICODE);
            }

            Log::warn($content);
        }
    }

    /**
     * 检测请求URI
     *
     * @param string $uri 请求URI
     *
     * @return array 检测结果
     */
    protected function checkRequestUri(string $uri): array
    {
        $nowUri = $uri;
        $checkRes = [
            'uri' => '',
            'error' => '',
        ];

        $uriRes = Tool::handleYafUri($nowUri);
        if (0 == \strlen($uriRes)) {
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
     *
     * @param string $uri        uri
     * @param array  $frameMap   框架处理映射
     * @param array  $projectMap 项目处理映射
     *
     * @return bool|string 结果
     */
    protected function getPreProcessFunction(string $uri, array $frameMap, array $projectMap)
    {
        $funcName = '';
        if (5 == \strlen($uri)) {
            $needTag = substr($uri, 1);
            $funcPrefix = '';
            if (ctype_digit($needTag)) {
                $funcName = $frameMap[$uri] ?? '';
                $funcPrefix = 'preProcessFrame';
            } elseif (ctype_alnum($needTag)) {
                $funcName = $projectMap[$uri] ?? '';
                $funcPrefix = 'preProcessProject';
            }
            if ((\strlen($funcName) > 0) && (0 !== strpos($funcName, $funcPrefix))) {
                $funcName = false;
            }
        }

        return $funcName;
    }

    /**
     * 基础启动服务
     *
     * @param array $registerMap 注册列表
     */
    protected function baseStart(array $registerMap)
    {
        $this->_server->set($this->_configs['swoole']);
        //绑定注册方法
        foreach ($registerMap as $eventName => $funcName) {
            $this->_server->on($eventName, [$this, $funcName]);
        }

        file_put_contents($this->_tipFile, '\e[1;36m start ' . SY_MODULE . ': \e[0m \e[1;31m \t[fail] \e[0m');
        //启动服务
        $this->_server->start();
    }

    protected function basicStart(Server $server)
    {
        @cli_set_process_title(SyInner::PROCESS_TYPE_MAIN . SY_MODULE . $this->_port);

        Dir::create(SY_ROOT . '/pidfile/');
        if (false === file_put_contents($this->_pidFile, $server->master_pid)) {
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
        if (SY_SYSTEM_USER == SyInner::SYSTEM_USER_ROOT) {
            //热加载,要求必须为root
            $server->reload();
        }

        $errCode = $server->getLastError();
        if ($errCode > 0) {
            $logStr = 'swoole work stop,workId='
                      . $workId
                      . ',errorCode='
                      . $errCode
                      . ',errorMsg='
                      . print_r(error_get_last(), true);
            Log::error($logStr);
        }
    }

    protected function basicWorkError(Server $server, $workId, $workPid, $exitCode)
    {
        if ($exitCode > 0) {
            $msg = 'swoole work error. work_id='
                   . $workId
                   . '|work_pid='
                   . $workPid
                   . '|exit_code='
                   . $exitCode
                   . '|err_msg='
                   . $server->getLastError();
            Log::error($msg);
        }
    }

    protected function handleReqExceptionByFrame(\Throwable $e): Result
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

    /**
     * 设置服务端类型
     *
     * @param array $allowTypes 支持类型列表
     */
    protected function setServerType(array $allowTypes)
    {
        $projectLength = \strlen(SY_PROJECT);
        $serverType = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules.' . substr(SY_MODULE, $projectLength) . '.type');
        if (!\in_array($serverType, $allowTypes, true)) {
            exit('服务端类型不支持' . PHP_EOL);
        }
        \define('SY_SERVER_TYPE', $serverType);

        if (SyInner::SERVER_TYPE_FRONT_GATE == $serverType) {
            $this->_configs['server']['cachenum']['wx'] = 1;
        } else {
            $this->_configs['server']['cachenum']['wx'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.wx', 0, true);
        }
    }

    private function checkSystemEnv()
    {
        if (PHP_INT_SIZE < 8) {
            exit('操作系统必须是64位' . PHP_EOL);
        }
        if (version_compare(PHP_VERSION, SyInner::VERSION_MIN_PHP, '<')) {
            exit('PHP版本必须大于等于' . SyInner::VERSION_MIN_PHP . PHP_EOL);
        }
        if (!\defined('SY_MODULE')) {
            exit('模块名称未定义' . PHP_EOL);
        }
        if (!\defined('SY_TOKEN')) {
            exit('令牌未定义' . PHP_EOL);
        }
        if (!ctype_alnum(SY_TOKEN)) {
            exit('令牌不合法' . PHP_EOL);
        }
        if (8 != \strlen(SY_TOKEN)) {
            exit('令牌不合法' . PHP_EOL);
        }
        if (!\in_array(SY_ENV, SyInner::$totalEnvProject, true)) {
            exit('环境类型不合法' . PHP_EOL);
        }

        $os = php_uname('s');
        if (!\in_array($os, SyInner::$totalEnvSystem, true)) {
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
            'runkit7',
        ];
        foreach ($extensionList as $extName) {
            if (!\extension_loaded($extName)) {
                exit('扩展' . $extName . '未加载' . PHP_EOL);
            }
        }

        if (version_compare(SWOOLE_VERSION, SyInner::VERSION_MIN_SWOOLE, '<')) {
            exit('swoole版本必须大于等于' . SyInner::VERSION_MIN_SWOOLE . PHP_EOL);
        }
        if (version_compare(SEASLOG_VERSION, SyInner::VERSION_MIN_SEASLOG, '<')) {
            exit('seaslog版本必须大于等于' . SyInner::VERSION_MIN_SEASLOG . PHP_EOL);
        }
        if (version_compare(YAC_VERSION, SyInner::VERSION_MIN_YAC, '<')) {
            exit('yac版本必须大于等于' . SyInner::VERSION_MIN_YAC . PHP_EOL);
        }
        if (version_compare(\YAF\VERSION, SyInner::VERSION_MIN_YAF, '<')) {
            exit('yaf版本必须大于等于' . SyInner::VERSION_MIN_YAF . PHP_EOL);
        }
        $runkitVersion = phpversion('runkit7');
        if (version_compare($runkitVersion, SyInner::VERSION_MIN_RUNKIT, '<')) {
            exit('runkit7版本必须大于等于' . SyInner::VERSION_MIN_RUNKIT . PHP_EOL);
        }
        $redisVersion = phpversion('redis');
        if (version_compare($redisVersion, SyInner::VERSION_MIN_REDIS, '<')) {
            exit('redis版本必须大于等于' . SyInner::VERSION_MIN_REDIS . PHP_EOL);
        }
    }

    private function createUniqueToken()
    {
        $execRes = Tool::execSystemCommand('ifconfig -a | awk \'{for(i=1;i<=NF;i++)if($i ~ "ether")print $(i+1);}\'');
        if ($execRes['code'] > 0) {
            exit($execRes['msg'] . PHP_EOL);
        }

        foreach ($execRes['data'] as $eMac) {
            $macAddress = trim($eMac);
            if (17 == \strlen($macAddress)) {
                self::$_uniqueToken = hash('crc32b', $macAddress . ':' . $this->_port);

                break;
            }
        }

        if (0 == \strlen(self::$_uniqueToken)) {
            exit('生成唯一码失败' . PHP_EOL);
        }
    }
}
