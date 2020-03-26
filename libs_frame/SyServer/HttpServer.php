<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 16:42
 */

namespace SyServer;

use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyException\Swoole\HttpServerException;
use Log\Log;
use Request\RequestSign;
use Response\Result;
use Response\SyResponseHttp;
use SyModule\ModuleContainer;
use SyTrait\Server\FrameHttpTrait;
use SyTrait\Server\FramePreProcessHttpTrait;
use SyTrait\Server\ProjectHttpTrait;
use SyTrait\Server\ProjectPreProcessHttpTrait;
use SyTool\SessionTool;
use SyTool\SyPack;
use SyTool\Tool;
use Yaf\Registry;
use Yaf\Request\Http;

class HttpServer extends BaseServer
{
    use FrameHttpTrait;
    use ProjectHttpTrait;
    use FramePreProcessHttpTrait;
    use ProjectPreProcessHttpTrait;

    const RESPONSE_RESULT_TYPE_FORBIDDEN = 0; //响应结果类型-拒绝请求
    const RESPONSE_RESULT_TYPE_ACCEPT = 1; //响应结果类型-允许请求执行业务

    /**
     * swoole请求cookie域名数组
     * @var array
     */
    private $_reqCookieDomains = [];
    /**
     * @var \SyTool\SyPack
     */
    private $_messagePack = null;
    /**
     * @var \SyModule\ModuleContainer
     */
    private $_moduleContainer = null;
    /**
     * HTTP响应
     * @var \Swoole\Http\Response
     */
    private static $_response = null;
    /**
     * 响应消息
     * @var string
     */
    private static $_rspMsg = '';
    /**
     * swoole请求头信息数组
     * @var array
     */
    private static $_reqHeaders = [];
    /**
     * swoole服务器信息数组
     * @var array
     */
    private static $_reqServers = [];
    /**
     * swoole task请求数据
     * @var string
     */
    private static $_reqTask = null;

    public function __construct(int $port)
    {
        parent::__construct($port);
        $this->setServerType([
            SyInner::SERVER_TYPE_API_GATE,
            SyInner::SERVER_TYPE_FRONT_GATE,
        ]);
        $this->_configs['server']['cachenum']['hc'] = 1;
        $this->_configs['server']['cachenum']['modules'] = (int) Tool::getArrayVal($this->_configs, 'server.cachenum.modules', 0, true);
        $this->_configs['server']['cachenum']['local'] = (int) Tool::getArrayVal($this->_configs, 'server.cachenum.local', 0, true);
        $this->checkServerHttp();
        $this->_messagePack = new SyPack();
        $this->_moduleContainer = new ModuleContainer();
        $this->_reqCookieDomains = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.domain.cookie');
    }

    private function __clone()
    {
    }

    public function start()
    {
        $this->initTableHttp();
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
            'request' => 'onRequest',
            'task' => 'onTask',
            'finish' => 'onFinish',
            'handshake' => 'onHandshake',
            'message' => 'onMessage',
            'close' => 'onClose',
        ]);
    }

    /**
     * 生成web socket服务端签名
     * @param string $socketKey 客户端密钥
     * @return bool|string
     */
    public static function createSocketAccept(string $socketKey)
    {
        if (is_null($socketKey)) {
            return false;
        } elseif (preg_match('/^[0-9a-zA-Z\+\/]{21}[AQgw]\={2}$/', $socketKey) == 0) {
            return false;
        } elseif (strlen(base64_decode($socketKey, true)) != 16) {
            return false;
        }

        return base64_encode(sha1($socketKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
    }

    /**
     * 校验服务端签名是否正确
     * @param string $socketKey 客户端密钥
     * @param string $socketAccept 服务端签名
     * @return bool
     * @throws \SyException\Swoole\HttpServerException
     */
    public static function checkSocketAccept(string $socketKey, string $socketAccept): bool
    {
        if (is_null($socketAccept)) {
            throw new HttpServerException('服务端签名不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        $nowAccept = self::createSocketAccept($socketKey);
        if ($nowAccept === false) {
            return false;
        } else {
            return $nowAccept === $socketAccept;
        }
    }

    public function onStart(\Swoole\Server $server)
    {
        $this->basicStart($server);
        $this->addTaskBase($server);
        $this->_messagePack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => SY_MODULE,
            'task_command' => Project::TASK_TYPE_REFRESH_TOKEN_EXPIRE,
            'task_params' => [],
        ]);
        $taskDataToken = $this->_messagePack->packData();
        $this->_messagePack->init();

        $server->tick(Project::TIME_TASK_REFRESH_TOKEN_EXPIRE, function () use ($server, $taskDataToken) {
            $server->task($taskDataToken);
        });
        $this->addTaskHttpTrait($server);
    }

    public function onWorkerStop(\Swoole\Server $server, int $workerId)
    {
        $this->basicWorkStop($server, $workerId);
    }

    public function onWorkerError(\Swoole\Server $server, $workId, $workPid, $exitCode)
    {
        $this->basicWorkError($server, $workId, $workPid, $exitCode);

        if (self::$_response) {
            $this->setRspCookies(self::$_response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_COOKIE));
            $this->setRspHeaders(self::$_response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_HEADER));

            $json = new Result();
            $json->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, ErrorCode::getMsg(ErrorCode::COMMON_SERVER_ERROR));
            self::$_response->status(SY_HTTP_RSP_CODE_ERROR);
            self::$_response->end($json->getJson());
        }
    }

    /**
     * web socket握手
     * @param \Swoole\Http\Request  $request
     * @param \Swoole\Http\Response $response
     * @return bool
     */
    public function onHandshake(Request $request, Response $response)
    {
        $socketAccept = self::createSocketAccept(Tool::getArrayVal($request->header, 'sec-websocket-key', null));
        if ($socketAccept === false) {
            $response->end();
            return false;
        }

        $response->header('Upgrade', 'websocket');
        $response->header('Connection', 'Upgrade');
        $response->header('Sec-WebSocket-Accept', $socketAccept);
        $response->header('Sec-WebSocket-Version', '13');
        $response->header('Keep-Alive', 'off');
        $response->status(101);
        $response->end();

        $fd = $request->fd;
        $server = $this->_server;
        $this->_server->defer(function () use ($fd, $server) {
            $server->push($fd, 'hello, welcome', WEBSOCKET_OPCODE_TEXT);
        });

        return true;
    }

    /**
     * 接受socket消息
     * 消息格式：abcde
     * <pre>
     * 格式说明：
     *     a:消息头长度，值固定为16
     *     b:消息内容长度，无符号整数
     *     c:消息执行命令标识，4位字符串
     *     d:保留字段，值固定为0000
     *     e:消息内容，json格式
     * </pre>
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\WebSocket\Frame $frame
     */
    public function onMessage(Server $server, Frame $frame)
    {
        $result = new Result();
        if ($frame->opcode != WEBSOCKET_OPCODE_BINARY) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '只接受二进制数据');
            $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
            return;
        } elseif (!$frame->finish) { //数据未发送完
            return;
        }

        $message = $this->_messagePack->unpackData($frame->data);
        $command = $this->_messagePack->getCommand();
        $commandData = $this->_messagePack->getData();
        $this->_messagePack->init();
        if ($message === false) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '消息格式不正确');
            $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
            return;
        }

        switch ($command) {
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_CLOSE:
                $server->close($frame->fd);
                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_CHECK_STATUS:
                $result->setData([
                    'status' => $server->exist($frame->fd) ? 1 : 0,
                    'detail' => $server->exist($frame->fd) ? $server->connection_info($frame->fd, null, true) : [],
                ]);
                $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_GET_SERVER:
                $result->setData([
                    'sy_version' => SY_VERSION,
                    'server_type' => 'swoole-http-server',
                    'swoole_version' => SWOOLE_VERSION,
                    'yaf_version' => \YAF\VERSION,
                ]);
                $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_API_REQ:
                $module = $this->_moduleContainer->getObj($commandData['api_module']);

                try {
                    if (is_null($module)) {
                        $handleRes = false;
                    } elseif (($commandData['api_module'] == Project::MODULE_NAME_API) && ($commandData['api_method'] == 'GET')) {
                        $handleRes = $module->sendGetReq($commandData['api_uri'], $commandData['api_params']);
                    } elseif ($commandData['api_module'] == Project::MODULE_NAME_API) {
                        $handleRes = $module->sendPostReq($commandData['api_uri'], $commandData['api_params']);
                    } else {
                        $handleRes = $module->sendApiReq($commandData['api_uri'], $commandData['api_params']);
                    }
                    if ($handleRes === false) {
                        $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务处理失败');
                    } else {
                        $result = $handleRes;
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                    $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务出错');
                } finally {
                    if ($result instanceof Result) {
                        $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
                    } else {
                        $server->push($frame->fd, $result, WEBSOCKET_OPCODE_TEXT, true);
                    }
                }
                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ:
                $module = $this->_moduleContainer->getObj($commandData['task_module']);

                try {
                    if (is_null($module)) {
                        $handleRes = false;
                    } else {
                        $handleRes = $module->sendTaskReq($commandData['task_command'], $commandData['task_params']);
                    }
                    if ($handleRes === false) {
                        $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务处理失败');
                    } else {
                        $result->setData([
                            'result' => 'send task success',
                        ]);
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                    $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务出错');
                } finally {
                    $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
                }
                break;
            default:
                $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '命令不存在');
                $server->push($frame->fd, $result->getJson(), WEBSOCKET_OPCODE_TEXT, true);
                break;
        }
    }

    public function onTask(\Swoole\Server $server, int $taskId, int $fromId, string $data)
    {
        $baseRes = $this->handleTaskBase($server, $taskId, $fromId, $data);
        if (is_array($baseRes)) {
            $taskCommand = Tool::getArrayVal($baseRes['params'], 'task_command', '');
            switch ($taskCommand) {
                default:
                    $this->handleTaskHttpTrait($server, $taskId, $fromId, $baseRes);
            }
        }
    }

    /**
     * 处理请求
     * @param \Swoole\Http\Request $request
     * @param \Swoole\Http\Response $response
     */
    public function onRequest(Request $request, Response $response)
    {
        self::$_response = $response;
        $initRes = $this->initReceive($request);
        if (strlen($initRes) > 0) {
            self::$_rspMsg = $initRes;
        } elseif (is_null(self::$_reqTask)) {
            $rspHeaders = [];
            $handleHeaderRes = $this->handleReqHeader($rspHeaders);
            if ($handleHeaderRes == self::RESPONSE_RESULT_TYPE_ACCEPT) {
                self::$_rspMsg = $this->handleReqService($request, $rspHeaders);
                $this->setRspCookies($response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_COOKIE));
                $this->setRspHeaders($response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_HEADER));
            } else {
                $rspHeaders['Content-Type'] = 'text/plain; charset=utf-8';
                $rspHeaders[SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR] = 403;
                $this->setRspHeaders($response, $rspHeaders);
            }
        } else {
            self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
            $this->_server->task(self::$_reqTask, random_int(1, $this->_taskMaxId));
            $res = new Result();
            $res->setData([
                'msg' => 'task received',
            ]);
            self::$_rspMsg = $res->getJson();
        }

        $response->end(self::$_rspMsg);
        $this->clearRequest();
    }

    /**
     * 设置响应头信息
     * @param \Swoole\Http\Response $response
     * @param array|bool $headers
     */
    private function setRspHeaders(Response $response, $headers)
    {
        if (is_array($headers)) {
            if (!isset($headers['Content-Type'])) {
                $response->header('Content-Type', 'application/json; charset=utf-8');
            }

            foreach ($headers as $headerName => $headerVal) {
                $response->header($headerName, $headerVal);
            }

            if (isset($headers['Location'])) {
                $response->status(302);
            } elseif (isset($headers[SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR])) {
                $response->status($headers[SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR]);
            }
        } else {
            $response->header('Access-Control-Allow-Origin', '*');
            $response->header('Content-Type', 'application/json; charset=utf-8');
        }
    }

    /**
     * 设置响应cookie信息
     * @param \Swoole\Http\Response $response
     * @param array|bool $cookies
     */
    private function setRspCookies(Response $response, $cookies)
    {
        if (is_array($cookies)) {
            foreach ($cookies as $cookie) {
                $value = Tool::getArrayVal($cookie, 'value', null);
                $expires = Tool::getArrayVal($cookie, 'expires', 0);
                $path = Tool::getArrayVal($cookie, 'path', '/');
                $domain = Tool::getArrayVal($cookie, 'domain', '');
                $secure = Tool::getArrayVal($cookie, 'secure', false);
                $httpOnly = Tool::getArrayVal($cookie, 'httponly', false);
                $response->cookie($cookie['key'], $value, $expires, $path, $domain, $secure, $httpOnly);
            }
        }
    }

    /**
     * 初始化公共数据
     * @param \Swoole\Http\Request $request
     * @return string
     */
    private function initReceive(Request $request)
    {
        $_GET = $request->get ?? [];
        $_POST = $request->post ?? [];
        $_FILES = $request->files ?? [];
        $_COOKIE = $request->cookie ?? [];
        $GLOBALS['HTTP_RAW_POST_DATA'] = $request->rawContent();
        $_SESSION = [];
        Registry::del(SyInner::REGISTRY_NAME_SERVICE_ERROR);
        self::$_reqHeaders = $request->header ?? [];
        self::$_reqServers = $request->server ?? [];
        self::$_rspMsg = '';

        if (isset($request->header['content-type']) && ($request->header['content-type'] == 'application/json')) {
            $_POST = Tool::jsonDecode($request->rawContent());
            if (!is_array($_POST)) {
                $res = new Result();
                $res->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, 'JSON格式不正确');
                return $res->getJson();
            }
        }
        $tokenExpireTime = (int) self::$_syServer->get(self::$_serverToken, 'token_etime');
        if ($tokenExpireTime <= time()) {
            $res = new Result();
            $res->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '令牌已过期');
            return $res->getJson();
        }

        $taskData = $_POST[SyInner::SERVER_DATA_KEY_TASK] ?? '';
        self::$_reqTask = is_string($taskData) && (strlen($taskData) > 0) ? $taskData : null;

        $_SERVER = [];
        foreach (self::$_reqServers as $key => $val) {
            $_SERVER[strtoupper($key)] = $val;
        }
        foreach (self::$_reqHeaders as $key => $val) {
            $_SERVER[strtoupper($key)] = $val;
        }
        if (!isset($_SERVER['HTTP_HOST'])) {
            $_SERVER['HTTP_HOST'] = $this->_host . ':' . $this->_port;
        }
        if (!isset($_SERVER['REQUEST_URI'])) {
            $_SERVER['REQUEST_URI'] = '/';
        }

        $nowTime = time();
        $_SERVER[SyInner::SERVER_DATA_KEY_TIMESTAMP] = $nowTime;
        $_SERVER['SYREQ_ID'] = hash('md4', $nowTime . Tool::createNonceStr(8));
        $this->initLanguageType();
        return '';
    }

    private function initRequest(Request $request, array $rspHeaders)
    {
        self::$_reqStartTime = microtime(true);
        self::$_syServer->incr(self::$_serverToken, 'request_times', 1);
        $_POST[RequestSign::KEY_SIGN] = $_GET[RequestSign::KEY_SIGN] ?? '';
        unset($_GET[RequestSign::KEY_SIGN]);
        //注册全局信息
        Registry::set(SyInner::REGISTRY_NAME_REQUEST_HEADER, self::$_reqHeaders);
        Registry::set(SyInner::REGISTRY_NAME_REQUEST_SERVER, self::$_reqServers);
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_HEADER, $rspHeaders);
        Registry::set(SyInner::REGISTRY_NAME_RESPONSE_COOKIE, []);
        SessionTool::initSessionJwt();
    }

    /**
     * 清理请求数据
     */
    private function clearRequest()
    {
        $_GET = [];
        $_POST = [];
        $_FILES = [];
        $_COOKIE = [];
        $_SERVER = [];
        $_SESSION = [];
        $GLOBALS['HTTP_RAW_POST_DATA'] = '';
        self::$_reqTask = null;
        self::$_reqHeaders = [];
        self::$_reqServers = [];
        self::$_response = null;
        self::$_rspMsg = '';

        //清除yaf注册常量
        Registry::del(SyInner::REGISTRY_NAME_REQUEST_HEADER);
        Registry::del(SyInner::REGISTRY_NAME_REQUEST_SERVER);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_HEADER);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_COOKIE);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_JWT_SESSION);
        Registry::del(SyInner::REGISTRY_NAME_RESPONSE_JWT_DATA);

        self::$_syServer->set(self::$_serverToken, [
            'memory_usage' => memory_get_usage(),
        ]);
    }

    /**
     * 处理请求头
     * @param array $headers 响应头配置
     * @return int
     */
    private function handleReqHeader(array &$headers): int
    {
        $domainTag = $_SERVER['SY-DOMAIN'] ?? 'base';
        $cookieDomain = $this->_reqCookieDomains[$domainTag] ?? null;
        if (is_null($cookieDomain)) {
            return self::RESPONSE_RESULT_TYPE_FORBIDDEN;
        }
        $_SERVER['SY-DOMAIN'] = $cookieDomain;
        return self::RESPONSE_RESULT_TYPE_ACCEPT;
    }

    /**
     * 处理请求业务
     * @param \Swoole\Http\Request $request
     * @param array $initRspHeaders 初始化响应头
     * @return string
     */
    private function handleReqService(Request $request, array $initRspHeaders): string
    {
        $uri = Tool::getArrayVal(self::$_reqServers, 'request_uri', '/');
        $uriCheckRes = $this->checkRequestUri($uri);
        if (strlen($uriCheckRes['error']) > 0) {
            return $uriCheckRes['error'];
        }
        $uri = $uriCheckRes['uri'];
        self::$_reqServers['request_uri'] = $uriCheckRes['uri'];

        $funcName = $this->getPreProcessFunction($uri, $this->preProcessMapFrame, $this->preProcessMapProject);
        if (is_bool($funcName)) {
            $error = new Result();
            $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '预处理函数命名不合法');
            $result = $error->getJson();
            unset($error);
            return $result;
        } elseif (strlen($funcName) > 0) {
            return $this->$funcName($request);
        }

        $this->initRequest($request, $initRspHeaders);

        $error = null;
        $result = '';
        $httpObj = new Http($uri);
        try {
            self::checkRequestCurrentLimit();
            $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
            if (strlen($result) == 0) {
                $error = new Result();
                $error->setCodeMsg(ErrorCode::SWOOLE_SERVER_NO_RESPONSE_ERROR, '未设置响应数据');
            }
        } catch (\Throwable $e) {
            SyResponseHttp::header('Content-Type', 'application/json; charset=utf-8');
            if (SY_REQ_EXCEPTION_HANDLE_TYPE) {
                $error = $this->handleReqExceptionByFrame($e);
            } else {
                $error = $this->handleReqExceptionByProject($e);
            }
        } finally {
            self::$_syServer->decr(self::$_serverToken, 'request_handling', 1);
            $this->reportLongTimeReq($uri, array_merge($_GET, $_POST), Project::TIME_EXPIRE_SWOOLE_CLIENT_HTTP);
            unset($httpObj);
            if (is_object($error)) {
                $result = $error->getJson();
                unset($error);
            }
        }

        return $result;
    }
}
