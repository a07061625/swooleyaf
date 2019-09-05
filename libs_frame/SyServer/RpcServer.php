<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:33
 */
namespace SyServer;

use Constant\ErrorCode;
use Constant\Project;
use Constant\Server;
use Log\Log;
use Request\RequestSign;
use Response\Result;
use Tool\SessionTool;
use Tool\SyPack;
use Tool\Tool;
use SyTrait\PreProcessRpcFrameTrait;
use SyTrait\PreProcessRpcProjectTrait;
use SyTrait\RpcServerTrait;
use SyTrait\Server\BasicRpcTrait;
use Yaf\Registry;
use Yaf\Request\Http;

class RpcServer extends BaseServer
{
    use BasicRpcTrait;
    use RpcServerTrait;
    use PreProcessRpcFrameTrait;
    use PreProcessRpcProjectTrait;

    /**
     * @var \Tool\SyPack
     */
    private $_receivePack = null;

    public function __construct(int $port)
    {
        parent::__construct($port);
        $projectLength = strlen(SY_PROJECT);
        $serverType = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.modules.' . substr(SY_MODULE, $projectLength) . '.type');
        if ($serverType != Server::SERVER_TYPE_API_MODULE) {
            exit('服务端类型不支持' . PHP_EOL);
        }
        define('SY_SERVER_TYPE', $serverType);
        $this->_configs['server']['cachenum']['hc'] = 1;
        $this->_configs['server']['cachenum']['modules'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.modules', 0, true);
        $this->_configs['server']['cachenum']['local'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.local', 0, true);
        $this->_configs['server']['cachenum']['wx'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.wx', 0, true);
        $this->checkServerRpc();
        $this->_configs['swoole']['package_length_type'] = 'L';
        $this->_configs['swoole']['package_length_offset'] = 4;
        $this->_configs['swoole']['package_body_offset'] = 0;
        $this->_receivePack = new SyPack();
    }

    private function __clone()
    {
    }

    public function start()
    {
        $this->initTableRpc();
        //初始化swoole服务
        $this->_server = new \swoole_server($this->_host, $this->_port);
        $this->baseStart([
            'start' => 'onStart',
            'managerStart' => 'onManagerStart',
            'workerStart' => 'onWorkerStart',
            'workerStop' => 'onWorkerStop',
            'workerError' => 'onWorkerError',
            'workerExit' => 'onWorkerExit',
            'shutdown' => 'onShutdown',
            'receive' => 'onReceive',
            'task' => 'onTask',
            'finish' => 'onFinish',
            'close' => 'onClose',
        ]);
    }

    public function onStart(\swoole_server $server)
    {
        $this->basicStart($server);
        $this->addTaskBase($server);
        $this->addTaskRpcTrait($server);
    }

    public function onWorkerStop(\swoole_server $server, int $workerId)
    {
        $this->basicWorkStop($server, $workerId);
    }

    public function onWorkerError(\swoole_server $server, $workId, $workPid, $exitCode)
    {
        $this->basicWorkError($server, $workId, $workPid, $exitCode);
    }

    public function onTask(\swoole_server $server, int $taskId, int $fromId, string $data)
    {
        $baseRes = $this->handleTaskBase($server, $taskId, $fromId, $data);
        if (is_array($baseRes)) {
            $taskCommand = Tool::getArrayVal($baseRes['params'], 'task_command', '');
            switch ($taskCommand) {
                default:
                    $this->handleTaskRpcTrait($server, $taskId, $fromId, $baseRes);
            }
        }
    }

    /**
     * 处理请求
     * @param \swoole_server $server
     * @param int $fd TCP客户端连接的唯一标识符
     * @param int $reactor_id Reactor线程ID
     * @param string $data 收到的数据内容
     */
    public function onReceive(\swoole_server $server, int $fd, int $reactor_id, string $data)
    {
        $this->initReceive($server);
        $result = $this->handleReceive($server, $data);
        $this->_receivePack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_SERVER_SEND_RSP, [
            'rsp_data' => $result,
        ]);
        $rspData = $this->_receivePack->packData();
        $this->_receivePack->init();

        $sendRes = $server->send($fd, $rspData);
        if (!$sendRes) {
            Log::error('rpc send response error, error_code:' . $server->getLastError());
        }
    }

    /**
     * 初始化请求数据
     * @param array $data
     */
    private function initRequest(array $data)
    {
        $_GET = [];
        $_POST = $data;
        $_COOKIE = [];
        $_FILES = [];
        $_SESSION = [];
        $_SERVER['SYREQ_ID'] = $data['__req_id'] ?? hash('md4', Tool::getNowTime() . Tool::createNonceStr(8));
        unset($_POST[RequestSign::KEY_SIGN]);
        unset($_POST['__req_id']);

        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);
        SessionTool::initSessionJwt();
    }

    /**
     * 清理
     */
    private function clearRequest()
    {
        $_GET = [];
        $_POST = [];
        $_COOKIE = [];
        $_FILES = [];
        $_SESSION = [];
        unset($_SERVER['SYREQ_ID']);

        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);
        Registry::del(Server::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        Registry::del(Server::REGISTRY_NAME_RESPONSE_JWT_DATA);
    }

    private function initReceive(\swoole_server $server)
    {
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        $_SERVER[Server::SERVER_DATA_KEY_TIMESTAMP] = time();
    }

    private function handleApiReceive(array $data)
    {
        $uriCheckRes = $this->checkRequestUri($data['api_uri']);
        if (strlen($uriCheckRes['error']) > 0) {
            return $uriCheckRes['error'];
        }
        $data['api_uri'] = $uriCheckRes['uri'];

        self::$_reqStartTime = microtime(true);
        $this->initRequest($data['api_params']);

        $error = null;
        $result = '';
        $httpObj = null;
        try {
            self::checkRequestCurrentLimit();
            $funcName = $this->getPreProcessFunction($data['api_uri'], $this->preProcessMapFrame, $this->preProcessMapProject);
            if (is_string($funcName)) {
                if (strlen($funcName) == 0) {
                    $httpObj = new Http($data['api_uri']);
                    $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
                } else {
                    $result = $this->$funcName($data);
                }
                if (strlen($result) == 0) {
                    $error = new Result();
                    $error->setCodeMsg(ErrorCode::SWOOLE_SERVER_NO_RESPONSE_ERROR, '未设置响应数据');
                }
            } else {
                $error = new Result();
                $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '预处理函数命名不合法');
            }
        } catch (\Exception $e) {
            if (SY_REQ_EXCEPTION_HANDLE_TYPE) {
                $error = $this->handleReqExceptionByFrame($e);
            } else {
                $error = $this->handleReqExceptionByProject($e);
            }
        } finally {
            self::$_syServer->decr(self::$_serverToken, 'request_handling', 1);
            $this->clearRequest();
            $this->reportLongTimeReq($data['api_uri'], $data['api_params'], Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
            unset($httpObj);
            if (is_object($error)) {
                $result = $error->getJson();
                unset($error);
            }
        }

        return $result;
    }

    private function handleTaskReceive(\swoole_server $server, string $data)
    {
        $server->task($data, random_int(1, $this->_taskMaxId));
        $result = new Result();
        $result->setData([
            'msg' => 'task received',
        ]);

        return $result->getJson();
    }

    private function handleReceive(\swoole_server $server, string $data)
    {
        if (!$this->_receivePack->unpackData($data)) {
            $error = new Result();
            $error->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '请求数据格式错误');
            $result = $error->getJson();
            unset($error);
            return $result;
        }

        $command = $this->_receivePack->getCommand();
        $commandData = $this->_receivePack->getData();
        switch ($command) {
            case SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ:
                $result = $this->handleApiReceive($commandData);
                break;
            case SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ:
                $result = $this->handleTaskReceive($server, $data);
                break;
            default:
                $error = new Result();
                $error->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '请求命令不支持');
                $result = $error->getJson();
                unset($error);
        }
        Registry::del(Server::REGISTRY_NAME_SERVICE_ERROR);

        return $result;
    }
}
