<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-3-22
 * Time: 下午11:04
 */
namespace SyServer;

use Swoole\Process;
use SyConstant\ErrorCode;
use SyConstant\SyInner;
use DesignPatterns\Singletons\MysqlSingleton;
use DesignPatterns\Singletons\RedisSingleton;
use SyLog\Log;
use PoolService\ProcessService\ProcessServiceManager;
use Response\Result;
use SyTrait\Server\FrameProcessPoolTrait;
use SyTrait\Server\ProjectProcessPoolTrait;
use SyTool\Dir;
use SyTool\Tool;

class ProcessPoolServer
{
    use FrameProcessPoolTrait;
    use ProjectProcessPoolTrait;

    /**
     * 提示文件
     * @var string
     */
    protected $_tipFile = '';

    /**
     * 连接池对象
     * @var \Swoole\Process\Pool
     */
    private $pool = null;
    /**
     * 请求域名
     * @var string
     */
    private $_host = '';
    /**
     * 请求端口
     * @var int
     */
    private $_port = 0;
    /**
     * pid文件
     * @var string
     */
    private $_pidFile = '';
    /**
     * 配置数组
     * @var array
     */
    private $_configs = [];
    /**
     * 连接池对象
     * @var \PoolService\ProcessService\ProcessServiceManager
     */
    private $serviceManager = null;

    public function __construct(int $port)
    {
        if (($port <= SyInner::ENV_PORT_MIN) || ($port > SyInner::ENV_PORT_MAX)) {
            exit('端口不合法' . PHP_EOL);
        }

        $this->checkSystemEnv();
        $this->_configs = Tool::getConfig('sypool.' . SY_ENV . SY_MODULE);
        $this->checkPoolFrame();
        $this->checkPoolProject();

        define('SY_SERVER_IP', $this->_configs['process']['host']);

        $this->_configs['process']['port'] = $port;

        Dir::create(SY_ROOT . '/pidfile/');
        Dir::create(SY_ROOT . '/tipfile/');
        $this->_host = $this->_configs['process']['host'];
        $this->_port = $this->_configs['process']['port'];
        $this->_pidFile = SY_ROOT . '/pidfile/' . SY_MODULE . $this->_port . '.pid';
        $this->_tipFile = SY_ROOT . '/tipfile/' . SY_MODULE . $this->_port . '.txt';
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
        $this->serviceManager = new ProcessServiceManager();

        //设置日志目录
        Log::setPath(SY_LOG_PATH);
    }

    private function __clone()
    {
    }

    public function help()
    {
        print_r('帮助信息' . PHP_EOL);
        print_r('-s 操作类型: restart-重启 stop-关闭 start-启动 startstatus-启动状态' . PHP_EOL);
        print_r('-module 模块名' . PHP_EOL);
        print_r('-port 端口,取值范围为1024-65535' . PHP_EOL);
    }

    public function start()
    {
        $execRes = Tool::execSystemCommand('lsof -i:' . $this->_port);
        if ($execRes['code'] > 0) {
            exit($execRes['msg'] . PHP_EOL);
        } elseif (!empty($execRes['data'])) {
            exit('端口被占用' . PHP_EOL);
        }

        $this->initTableFrame();
        $this->initTableProject();

        @cli_set_process_title(SyInner::PROCESS_TYPE_MAIN . SY_MODULE . $this->_port);
        Process::daemon(true, false);
        file_put_contents($this->_pidFile, getmypid());
        file_put_contents($this->_tipFile, '\e[1;36m start ' . SY_MODULE . ': \e[0m \e[1;31m \t[fail] \e[0m');

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

        $this->pool = new Process\Pool($this->_configs['process']['num']['worker'], SWOOLE_IPC_SOCKET);
        $this->pool->on('workerStart', [$this, 'onWorkerStart']);
        $this->pool->on('workerStop', [$this, 'onWorkerStop']);
        $this->pool->on('message', [$this, 'onMessage']);
        $this->pool->listen($this->_host, $this->_port, $this->_configs['process']['num']['backlog']);
        $this->pool->start();
    }

    public function stop()
    {
        if (is_file($this->_pidFile) && is_readable($this->_pidFile)) {
            $pid = (int)file_get_contents($this->_pidFile);
        } else {
            $pid = 0;
        }

        $msg = ' \e[1;31m \t[fail]';
        if ($pid > 0) {
            if (Process::kill($pid)) {
                $msg = ' \e[1;32m \t[success]';
            }
            file_put_contents($this->_pidFile, '');
        }
        system('echo -e "\e[1;36m stop ' . SY_MODULE . ': \e[0m' . $msg . ' \e[0m"');
        exit();
    }

    /**
     * 获取服务启动状态
     */
    public function getStartStatus()
    {
        $fileContent = file_get_contents($this->_tipFile);
        $command = 'echo -e "\e[1;31m ' . SY_MODULE . ' start status fail \e[0m"';
        if (is_string($fileContent)) {
            if (strlen($fileContent) > 0) {
                $command = 'echo -e "' . $fileContent . '"';
            }
            file_put_contents($this->_tipFile, '');
        }
        system($command);
        exit();
    }
    
    public function onWorkerStart(Process\Pool $pool, int $workerId)
    {
        @cli_set_process_title(SyInner::PROCESS_TYPE_WORKER . SY_MODULE . $this->_port);

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

        if ($workerId == 0) {
            file_put_contents($this->_tipFile, '\e[1;36m start ' . SY_MODULE . ': \e[0m \e[1;32m \t[success] \e[0m');
        }

        $this->handleProjectWorkerStart($pool, $workerId);
    }

    public function onWorkerStop(Process\Pool $pool, int $workerId)
    {
        $this->handleProjectWorkerStop($pool, $workerId);
    }

    public function onMessage(Process\Pool $pool, string $data)
    {
        $result = new Result();
        $dataArr = Tool::jsonDecode($data);
        if (!is_array($dataArr)) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '数据格式错误');
        } elseif (!isset($dataArr['service_tag'])) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '数据格式错误');
        } elseif (!ctype_alnum($dataArr['service_tag'])) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '服务标识格式错误');
        } else {
            RedisSingleton::getInstance()->reConnect();
            if (SY_DATABASE) {
                MysqlSingleton::getInstance()->reConnect();
            }

            $result = $this->handleData($dataArr);
        }

        $pool->write($result->getJson());
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
        if (!in_array(SY_ENV, SyInner::$totalEnvProject, true)) {
            exit('环境类型不合法' . PHP_EOL);
        }

        $os = php_uname('s');
        if (!in_array($os, SyInner::$totalEnvSystem, true)) {
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
        if (version_compare(YAC_VERSION, SyInner::VERSION_MIN_YAC, '<')) {
            exit('yac版本必须大于等于' . SyInner::VERSION_MIN_YAC . PHP_EOL);
        }
        if (version_compare(\YAF\VERSION, SyInner::VERSION_MIN_YAF, '<')) {
            exit('yaf版本必须大于等于' . SyInner::VERSION_MIN_YAF . PHP_EOL);
        }
    }

    private function handleData(array $data)
    {
        $serviceClass = $this->serviceManager->getServiceName($data['service_tag']);
        if (strlen($serviceClass) > 0) {
            $serviceParams = Tool::getArrayVal($data, 'service_params', []);

            try {
                $result = $serviceClass::execMessage($serviceParams);
            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
                $result = new Result();
                if (is_int($e->getCode())) {
                    $result->setCodeMsg($e->getCode(), $e->getMessage());
                } else {
                    $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, $e->getMessage());
                }
            }
        } else {
            $result = new Result();
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '服务不存在');
        }

        return $result;
    }
}
