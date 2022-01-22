<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/19 0019
 * Time: 8:33
 */

namespace SyServer;

use Response\Result;
use Swoole\Server;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyLog\Log;
use SyTool\SessionTool;
use SyTool\SyPack;
use SyTool\Tool;
use SyTrait\Server\FramePreProcessRpcTrait;
use SyTrait\Server\FrameRpcTrait;
use SyTrait\Server\ProjectPreProcessRpcTrait;
use SyTrait\Server\ProjectRpcTrait;
use Yaf\Registry;

class RpcServer extends BaseServer
{
    use FrameRpcTrait;
    use ProjectRpcTrait;
    use FramePreProcessRpcTrait;
    use ProjectPreProcessRpcTrait;

    /**
     * @var \SyTool\SyPack
     */
    private $_receivePack;

    public function __construct(int $port)
    {
        parent::__construct($port);
        $this->setServerType([
            SyInner::SERVER_TYPE_API_MODULE,
        ]);
        $this->_configs['server']['cachenum']['hc'] = 1;
        $this->_configs['server']['cachenum']['modules'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.modules', 0, true);
        $this->_configs['server']['cachenum']['local'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.local', 0, true);
        $this->checkServerRpc();
        $this->_configs['swoole']['package_length_type'] = 'L';
        $this->_configs['swoole']['package_length_offset'] = 4;
        $this->_configs['swoole']['package_body_offset'] = 0;
        $this->_configs['swoole']['open_tcp_keepalive'] = true; //开启死连接检测
        $this->_configs['swoole']['tcp_keepidle'] = 5; //5s没有数据传输就进行检测
        $this->_configs['swoole']['tcp_keepinterval'] = 2; //2s探测一次
        $this->_configs['swoole']['tcp_keepcount'] = 3; //超过5次探测后还没回包close此连接
        $this->_receivePack = new SyPack();
    }

    private function __clone()
    {
        //do nothing
    }

    public function start()
    {
        $this->initTableRpc();
        //初始化swoole服务
        $this->_server = new Server($this->_host, $this->_port);
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
        ]);
    }

    public function onWorkerStop(Server $server, int $workerId)
    {
        $this->basicWorkStop($server, $workerId);
    }

    public function onWorkerError(Server $server, $workId, $workPid, $exitCode)
    {
        $this->basicWorkError($server, $workId, $workPid, $exitCode);
    }

    /**
     * 处理请求
     *
     * @param int    $fd         TCP客户端连接的唯一标识符
     * @param int    $reactor_id Reactor线程ID
     * @param string $data       收到的数据内容
     */
    public function onReceive(Server $server, int $fd, int $reactor_id, string $data)
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
     */
    private function initRequest(array $data)
    {
        $_GET = [];
        $_POST = $data;
        $_COOKIE = [];
        $_FILES = [];
        $_SESSION = [];
        if (ctype_alnum($data['__req_id'])) {
            $_SERVER[Project::DATA_KEY_REQUEST_ID_SERVER] = $data['__req_id'];
        } else {
            $_SERVER[Project::DATA_KEY_REQUEST_ID_SERVER] = hash('md4', Tool::getNowTime() . Tool::createNonceStr(8));
        }
        unset($_POST[Project::DATA_KEY_SIGN_PARAMS], $_POST['__req_id']);

        Registry::del(SyInner::REGISTRY_NAME_SERVICE_ERROR);

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

        Registry::del(SyInner::REGISTRY_NAME_SERVICE_ERROR);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);
    }

    private function initReceive(Server $server)
    {
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        $_SERVER[SyInner::SERVER_DATA_KEY_TIMESTAMP] = time();
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_HEADER, []);
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_COOKIE, []);
    }

    private function handleApiReceive(array $data)
    {
        $uriCheckRes = $this->checkRequestUri($data['api_uri']);
        if (\strlen($uriCheckRes['error']) > 0) {
            return $uriCheckRes['error'];
        }
        $data['api_uri'] = $uriCheckRes['uri'];

        self::$_reqStartTime = microtime(true);
        $this->initRequest($data['api_params']);

        $error = null;
        $result = '';

        try {
            self::checkRequestCurrentLimit();
            $funcName = $this->getPreProcessFunction($data['api_uri'], $this->preProcessMapFrame, $this->preProcessMapProject);
            if (\is_string($funcName)) {
                $result = 0 == \strlen($funcName) ? $this->handleAppReqRpc($data) : $this->{$funcName}($data);
                if (0 == \strlen($result)) {
                    $error = new Result();
                    $error->setCodeMsg(ErrorCode::SWOOLE_SERVER_NO_RESPONSE_ERROR, '未设置响应数据');
                }
            } else {
                $error = new Result();
                $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '预处理函数命名不合法');
            }
        } catch (\Throwable $e) {
            if (SY_REQ_EXCEPTION_HANDLE_TYPE) {
                $error = $this->handleReqExceptionByFrame($e);
            } else {
                $error = $this->handleReqExceptionByProject($e);
            }
        } finally {
            self::$_syServer->decr(self::$_serverToken, 'request_handling', 1);
            $this->clearRequest();
            $this->reportLongTimeReq($data['api_uri'], $data['api_params'], Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
            if (\is_object($error)) {
                $result = $error->getJson();
                unset($error);
            }
        }

        return $result;
    }

    private function handleTaskReceive(Server $server, string $data)
    {
        $server->task($data, random_int(1, $this->_taskMaxId));
        $result = new Result();
        $result->setData([
            'msg' => 'task received',
        ]);

        return $result->getJson();
    }

    private function handleReceive(Server $server, string $data)
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

        $resultArr = Tool::jsonDecode($result);
        $rspHeaders = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_HEADER);
        $resultArr[Project::DATA_KEY_RESPONSE_CONTENT_HEADERS] = false !== $rspHeaders ? $rspHeaders : [];
        $rspCookies = Registry::get(SyInner::REGISTRY_NAME_RESPONSE_COOKIE);
        $resultArr[Project::DATA_KEY_RESPONSE_CONTENT_COOKIES] = false !== $rspCookies ? $rspCookies : [];

        Registry::del(SyInner::REGISTRY_NAME_SERVICE_ERROR);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_HEADER);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_COOKIE);

        return Tool::jsonEncode($resultArr, JSON_UNESCAPED_UNICODE);
    }
}
