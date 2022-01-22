<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 16:42
 */

namespace SyServer;

use Response\Result;
use Response\SyResponseHttp;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyException\Swoole\HttpServerException;
use SyLog\Log;
use SyModule\ModuleContainer;
use SyTool\SessionTool;
use SyTool\SyPack;
use SyTool\Tool;
use SyTrait\Server\FrameHttpTrait;
use SyTrait\Server\FramePreProcessHttpTrait;
use SyTrait\Server\ProjectHttpTrait;
use SyTrait\Server\ProjectPreProcessHttpTrait;
use Yaf\Registry;

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
     *
     * @var array
     */
    private $_reqCookieDomains = [];
    /**
     * @var \SyTool\SyPack
     */
    private $_messagePack;
    /**
     * @var \SyModule\ModuleContainer
     */
    private $_moduleContainer;
    /**
     * HTTP响应
     *
     * @var \Swoole\Http\Response
     */
    private static $_response = null;
    /**
     * 响应消息
     *
     * @var string
     */
    private static $_rspMsg = '';
    /**
     * swoole请求头信息数组
     *
     * @var array
     */
    private static $_reqHeaders = [];
    /**
     * swoole服务器信息数组
     *
     * @var array
     */
    private static $_reqServers = [];
    /**
     * swoole task请求数据
     *
     * @var string
     */
    private static $_reqTask = null;

    public function __construct(int $port)
    {
        parent::__construct($port);
        $this->_configs['swoole']['websocket_subprotocol'] = 'chat';
        $this->_configs['swoole']['websocket_compression'] = true;
        $this->setServerType([
            SyInner::SERVER_TYPE_API_GATE,
            SyInner::SERVER_TYPE_FRONT_GATE,
        ]);
        $this->_configs['server']['cachenum']['hc'] = 1;
        $this->_configs['server']['cachenum']['modules'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.modules', 0, true);
        $this->_configs['server']['cachenum']['local'] = (int)Tool::getArrayVal($this->_configs, 'server.cachenum.local', 0, true);
        $this->checkServerHttp();
        $this->_messagePack = new SyPack();
        $this->_moduleContainer = new ModuleContainer();
        $this->_reqCookieDomains = Tool::getConfig('project.' . SY_ENV . SY_PROJECT . '.domain.cookie');
    }

    private function __clone()
    {
        //do nothing
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
            'open' => 'onOpen',
            'message' => 'onMessage',
        ]);
    }

    /**
     * 生成web socket服务端签名
     *
     * @param string $socketKey 客户端密钥
     *
     * @return bool|string
     */
    public static function createSocketAccept(string $socketKey)
    {
        if (null === $socketKey) {
            return false;
        }
        if (0 == preg_match('/^[0-9a-zA-Z\+\/]{21}[AQgw]\={2}$/', $socketKey)) {
            return false;
        }
        if (16 != \strlen(base64_decode($socketKey, true))) {
            return false;
        }

        return base64_encode(sha1($socketKey . '258EAFA5-E914-47DA-95CA-C5AB0DC85B11', true));
    }

    /**
     * 校验服务端签名是否正确
     *
     * @param string $socketKey    客户端密钥
     * @param string $socketAccept 服务端签名
     *
     * @throws \SyException\Swoole\HttpServerException
     */
    public static function checkSocketAccept(string $socketKey, string $socketAccept): bool
    {
        if (null === $socketAccept) {
            throw new HttpServerException('服务端签名不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        $nowAccept = self::createSocketAccept($socketKey);
        if (false === $nowAccept) {
            return false;
        }

        return $nowAccept === $socketAccept;
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
     *
     * @return bool
     */
    public function onHandshake(Request $request, Response $response)
    {
        $socketAccept = self::createSocketAccept(Tool::getArrayVal($request->header, 'sec-websocket-key', null));
        if (false === $socketAccept) {
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
     * 客户端与服务器建立连接并完成握手后回调
     */
    public function onOpen(Server $server, Request $request)
    {
        //do nothing
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
     */
    public function onMessage(Server $server, Frame $frame)
    {
        if (!$frame->finish) { //数据未发送完
            return;
        }

        if (SWOOLE_WEBSOCKET_OPCODE_CLOSE == $frame->opcode) {
            Log::info('Close frame received,Code: ' . $frame->code . ';Reason: ' . $frame->reason);
        } elseif (SWOOLE_WEBSOCKET_OPCODE_PING == $frame->opcode) {
            $pongFrame = new Frame();
            $pongFrame->opcode = SWOOLE_WEBSOCKET_OPCODE_PONG;
            $server->push($frame->fd, $pongFrame);
        } elseif (SWOOLE_WEBSOCKET_OPCODE_PONG == $frame->opcode) {
            Log::info('Pong frame received');
        } else {
            $frameData = $frame->data ?? '';
            $handleRes = $this->handleFrameData($frame->opcode, $frameData);
            if (0 == $handleRes['type']) {
                $server->push(
                    $frame->fd,
                    $handleRes['data'],
                    SWOOLE_WEBSOCKET_OPCODE_TEXT,
                    SWOOLE_WEBSOCKET_FLAG_FIN | SWOOLE_WEBSOCKET_FLAG_COMPRESS
                );
            } elseif (1 == $handleRes['type']) {
                $server->close($frame->fd);
            } else {
                $result = new Result();
                if ($server->exist($frame->fd)) {
                    $result->setData([
                        'status' => 1,
                        'detail' => $server->getClientInfo($frame->fd),
                    ]);
                } else {
                    $result->setData([
                        'status' => 0,
                        'detail' => [],
                    ]);
                }
                $server->push(
                    $frame->fd,
                    $result->getJson(),
                    SWOOLE_WEBSOCKET_OPCODE_TEXT,
                    SWOOLE_WEBSOCKET_FLAG_FIN | SWOOLE_WEBSOCKET_FLAG_COMPRESS
                );
            }
        }
    }

    /**
     * 处理请求
     *
     * @throws \Exception
     */
    public function onRequest(Request $request, Response $response)
    {
        self::$_response = $response;
        $initRes = $this->initReceive($request);
        if (\strlen($initRes) > 0) {
            self::$_rspMsg = $initRes;
        } elseif (null === self::$_reqTask) {
            $rspHeaders = [];
            $handleHeaderRes = $this->handleReqHeader($rspHeaders);
            if (self::RESPONSE_RESULT_TYPE_ACCEPT == $handleHeaderRes) {
                self::$_rspMsg = $this->handleReqService($request, $rspHeaders);
            } else {
                $rspHeaders['Content-Type'] = 'text/plain; charset=utf-8';
                $rspHeaders[SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR] = 403;
                SyResponseHttp::headers($rspHeaders);
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

        $resultArr = Tool::jsonDecode(self::$_rspMsg);
        if (isset($resultArr['code']) && ($resultArr['code'] > 0)) {
            SyResponseHttp::header(SyInner::SERVER_DATA_KEY_HTTP_RSP_CODE_ERROR, SY_HTTP_RSP_CODE_ERROR);
        }
        $this->setRspHeaders($response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_HEADER));
        $this->setRspCookies($response, Registry::get(SyInner::REGISTRY_NAME_RESPONSE_COOKIE));

        if (isset($resultArr[Project::DATA_KEY_RESPONSE_CONTENT_STRING])) {
            $response->end($resultArr[Project::DATA_KEY_RESPONSE_CONTENT_STRING]);
        } else {
            $response->end(self::$_rspMsg);
        }
        $this->clearRequest();
    }

    /**
     * 处理帧数据
     *
     * @param int    $dataType 数据类型
     * @param string $data     数据
     */
    private function handleFrameData($dataType, string $data): array
    {
        $result = new Result();
        $handleRes = [
            'type' => 0,
        ];
        if (WEBSOCKET_OPCODE_BINARY != $dataType) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '只接受二进制数据');
            $handleRes['data'] = $result->getJson();

            return $handleRes;
        }

        $message = $this->_messagePack->unpackData($data);
        $command = $this->_messagePack->getCommand();
        $commandData = $this->_messagePack->getData();
        $this->_messagePack->init();

        if (false === $message) {
            $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '消息格式不正确');
            $handleRes['data'] = $result->getJson();

            return $handleRes;
        }

        switch ($command) {
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_CLOSE:
                $handleRes['type'] = 1;

                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_CHECK_STATUS:
                $handleRes['type'] = 2;

                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_GET_SERVER:
                $result->setData([
                    'sy_version' => SY_VERSION,
                    'server_type' => 'swoole-http-server',
                    'swoole_version' => SWOOLE_VERSION,
                    'yaf_version' => \YAF\VERSION,
                ]);
                $handleRes['data'] = $result->getJson();

                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_API_REQ:
                $module = $this->_moduleContainer->getObj($commandData['api_module']);

                try {
                    if (null === $module) {
                        $handleRes = false;
                    } elseif ((Project::MODULE_NAME_API == $commandData['api_module']) && ('GET' == $commandData['api_method'])) {
                        $handleRes = $module->sendGetReq($commandData['api_uri'], $commandData['api_params']);
                    } elseif (Project::MODULE_NAME_API == $commandData['api_module']) {
                        $handleRes = $module->sendPostReq($commandData['api_uri'], $commandData['api_params']);
                    } else {
                        $handleRes = $module->sendApiReq($commandData['api_uri'], $commandData['api_params']);
                    }
                    if (false === $handleRes) {
                        $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务处理失败');
                    } else {
                        $result = $handleRes;
                    }
                } catch (\Exception $e) {
                    Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
                    $result->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '服务出错');
                } finally {
                    $handleRes['data'] = $result instanceof Result ? $result->getJson() : $result;
                }

                break;
            case SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ:
                $module = $this->_moduleContainer->getObj($commandData['task_module']);

                try {
                    if (null === $module) {
                        $handleRes = false;
                    } else {
                        $handleRes = $module->sendTaskReq($commandData['task_command'], $commandData['task_params']);
                    }
                    if (false === $handleRes) {
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
                    $handleRes['data'] = $result->getJson();
                }

                break;
            default:
                $result->setCodeMsg(ErrorCode::COMMON_PARAM_ERROR, '命令不存在');
                $handleRes['data'] = $result->getJson();

                break;
        }

        return $handleRes;
    }

    /**
     * 设置响应头信息
     *
     * @param array|bool $headers
     */
    private function setRspHeaders(Response $response, $headers)
    {
        if (\is_array($headers)) {
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
     *
     * @param array|bool $cookies
     */
    private function setRspCookies(Response $response, $cookies)
    {
        if (\is_array($cookies)) {
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
     *
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

        $dataFormat = $request->header[Project::DATA_KEY_FORMAT_HEADER] ?? '';
        if ('json' == $dataFormat) {
            $_POST = Tool::jsonDecode($request->rawContent());
            if (!\is_array($_POST)) {
                $res = new Result();
                $res->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, 'JSON格式不正确');

                return $res->getJson();
            }
        }
        $tokenExpireTime = (int)self::$_syServer->get(self::$_serverToken, 'token_etime');
        if ($tokenExpireTime <= time()) {
            $res = new Result();
            $res->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '令牌已过期');

            return $res->getJson();
        }

        $taskData = $_POST[SyInner::SERVER_DATA_KEY_TASK] ?? '';
        self::$_reqTask = \is_string($taskData) && (\strlen($taskData) > 0) ? $taskData : null;

        $_SERVER = [];
        foreach (self::$_reqServers as $key => $val) {
            $_SERVER[strtoupper($key)] = $val;
        }
        foreach (self::$_reqHeaders as $key => $val) {
            $trueKey = trim($key);
            if ((\strlen($trueKey) > 0) && ('set-cookie' != $key)) {
                $_SERVER['HTTP_' . $trueKey] = trim($val);
            }
        }
        if (!isset($_SERVER['HTTP_host'])) {
            $_SERVER['HTTP_host'] = $this->_host . ':' . $this->_port;
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
        if (isset(self::$_reqHeaders[Project::DATA_KEY_SIGN_HEADER])) {
            $_POST[Project::DATA_KEY_SIGN_PARAMS] = self::$_reqHeaders[Project::DATA_KEY_SIGN_HEADER];
        } elseif (isset($_GET[Project::DATA_KEY_SIGN_PARAMS])) {
            $_POST[Project::DATA_KEY_SIGN_PARAMS] = $_GET[Project::DATA_KEY_SIGN_PARAMS];
        }
        unset($_GET[Project::DATA_KEY_SIGN_PARAMS]);
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
     *
     * @param array $headers 响应头配置
     */
    private function handleReqHeader(array &$headers): int
    {
        $domainTag = self::$_reqHeaders[Project::DATA_KEY_DOMAIN_COOKIE_HEADER] ?? 'base';
        $cookieDomain = $this->_reqCookieDomains[$domainTag] ?? null;
        if (null === $cookieDomain) {
            return self::RESPONSE_RESULT_TYPE_FORBIDDEN;
        }
        $_SERVER[Project::DATA_KEY_DOMAIN_COOKIE_SERVER] = $cookieDomain;

        return self::RESPONSE_RESULT_TYPE_ACCEPT;
    }

    /**
     * 处理请求业务
     *
     * @param array $initRspHeaders 初始化响应头
     */
    private function handleReqService(Request $request, array $initRspHeaders): string
    {
        $uri = Tool::getArrayVal(self::$_reqServers, 'request_uri', '/');
        $uriCheckRes = $this->checkRequestUri($uri);
        if (\strlen($uriCheckRes['error']) > 0) {
            return $uriCheckRes['error'];
        }
        $uri = $uriCheckRes['uri'];
        self::$_reqServers['request_uri'] = $uriCheckRes['uri'];

        $funcName = $this->getPreProcessFunction($uri, $this->preProcessMapFrame, $this->preProcessMapProject);
        if (\is_bool($funcName)) {
            $error = new Result();
            $error->setCodeMsg(ErrorCode::COMMON_SERVER_ERROR, '预处理函数命名不合法');
            $result = $error->getJson();
            unset($error);

            return $result;
        }
        if (\strlen($funcName) > 0) {
            return $this->{$funcName}($request);
        }

        $this->initRequest($request, $initRspHeaders);

        $error = null;
        $result = '';

        try {
            self::checkRequestCurrentLimit();
            $result = $this->handleAppReqHttp([
                'api_uri' => $uri,
            ], $request);
            if (0 == \strlen($result)) {
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
            if (\is_object($error)) {
                $result = $error->getJson();
                unset($error);
            }
        }

        return $result;
    }
}
