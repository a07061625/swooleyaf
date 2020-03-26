<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/6/26 0026
 * Time: 20:28
 */
namespace SyServer;

use Swoole\Client;
use Swoole\WebSocket\Server;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Swoole\HttpServerException;
use SyLog\Log;
use SyTool\SyPack;
use SyTool\Tool;

class SocketClient
{
    const TOKEN_LENGTH = 16;
    const VERSION = '0.1.0';

    /**
     * 客户端密钥
     * @var string
     */
    private $key = '';
    /**
     * 域名
     * @var string
     */
    private $host = '';
    /**
     * 端口
     * @var int
     */
    private $port = 0;
    /**
     * 请求uri
     * @var string
     */
    private $uri = '';
    /**
     * 来源地址
     * @var string
     */
    private $origin = '';
    /**
     * @var \Swoole\Client
     */
    private $socket = null;
    /**
     * 缓冲数据
     * @var string
     */
    private $buffer = '';
    /**
     * @var bool
     */
    private $connected = false;
    /**
     * @var \SyTool\SyPack
     */
    private $_syPack = null;

    /**
     * SocketClient constructor.
     * @param string $host
     * @param int    $port
     * @param string $uri
     * @param string $origin
     * @throws \SyException\Swoole\HttpServerException
     */
    public function __construct(string $host, int $port, string $uri = '/', string $origin = '')
    {
        if (strlen(trim($host)) == 0) {
            throw new HttpServerException('域名不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        if (($port <= 0) || ($port > 65535)) {
            throw new HttpServerException('端口不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        if (preg_match('/^\/\S*$/', $uri) == 0) {
            throw new HttpServerException('请求地址不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
        if ((strlen($origin) > 0) && (preg_match('/^(http|https)\:\/\/\S+$/', $origin) == 0)) {
            throw new HttpServerException('来源地址不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        $this->_syPack = new SyPack();
        $this->host = trim($host);
        $this->port = $port;
        $this->uri = $uri;
        $this->origin = $origin;
        $this->key = base64_encode(Tool::createNonceStr(self::TOKEN_LENGTH));
        $this->socket = new Client(SWOOLE_SOCK_TCP);
        $this->socket->set([
            'open_tcp_nodelay' => true,
            'socket_buffer_size' => Project::SIZE_CLIENT_SOCKET_BUFFER,
        ]);
        if (!$this->socket->connect($this->host, $this->port)) {
            throw new HttpServerException('连接服务器失败,code=' . $this->socket->errCode . '|msg=' . socket_strerror($this->socket->errCode), ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        $this->sendHeader();

        return $this->recv();
    }

    /**
     * Disconnect on destruct
     */
    public function __destruct()
    {
        $this->disconnect();
    }

    /**
     * 发送消息
     * @param string $command 命令，4位的字符串
     * @param array $data 数据
     * @param bool $masked
     * @return mixed
     */
    public function sendMessage(string $command, array $data, bool $masked = false)
    {
        $this->_syPack->setCommandAndData($command, $data);
        $packData = $this->_syPack->packData();
        $this->_syPack->init();

        if ($packData === false) {
            return false;
        } else {
            $message = Server::pack($packData, WEBSOCKET_OPCODE_BINARY, true, $masked);
            return $this->send($message);
        }
    }

    /**
     * 关闭socket
     */
    public function disconnect()
    {
        $this->connected = false;
        $this->socket->close();
    }

    public function close()
    {
        return $this->sendMessage(SyPack::COMMAND_TYPE_SOCKET_CLIENT_CLOSE, []);
    }

    /**
     * 接收服务端数据
     * @return mixed
     */
    public function recv()
    {
        $data = $this->socket->recv();
        if ($data === false) {
            Log::log('socket client error:' . $this->socket->errMsg);

            return false;
        }

        $this->buffer .= $data;
        $recvData = $this->parseData($this->buffer);
        if ($recvData) {
            $this->buffer = '';
            return $recvData;
        } else {
            return false;
        }
    }

    /**
     * 发送请求头
     * @return mixed
     */
    private function sendHeader()
    {
        $header = 'GET ' . $this->uri . " HTTP/1.1\r\n" .
                  'Origin: ' . $this->origin . "\r\n" .
                  'Host: ' . $this->host . ':' . $this->port . "\r\n" .
                  'Sec-WebSocket-Key: ' . $this->key . "\r\n" .
                  'User-Agent: PHPWebSocketClient/' . self::VERSION . "\r\n" .
                  "Upgrade: websocket\r\n" .
                  "Connection: Upgrade\r\n" .
                  "Sec-WebSocket-Protocol: wamp\r\n" .
                  "Sec-WebSocket-Version: 13\r\n\r\n";
        return $this->send($header);
    }

    /**
     * 发送数据
     * @param string $data
     * @return mixed
     */
    private function send(string $data)
    {
        $sendRes = $this->socket->send($data);
        if ($sendRes === false) {
            Log::error('socket client send data fail.' . PHP_EOL . 'errCode=' . $this->socket->errCode . '|data=' . $data);
        }

        return $sendRes;
    }

    /**
     * Parse raw incoming data
     * @param string $header
     * @return array
     */
    private function parseIncomingRaw(string $header)
    {
        $parseRes = [];
        $content = '';
        $fields = explode("\r\n", preg_replace('/\x0D\x0A[\x09\x20]+/', ' ', $header));
        foreach ($fields as $field) {
            if (preg_match('/([^:]+): (.+)/m', $field, $match)) {
                $match[1] = preg_replace_callback('/(?<=^|[\x09\x20\x2D])./', function ($matches) {
                    return strtoupper($matches[0]);
                }, strtolower(trim($match[1])));
                if (isset($parseRes[$match[1]])) {
                    $parseRes[$match[1]] = [$parseRes[$match[1]], $match[2]];
                } else {
                    $parseRes[$match[1]] = trim($match[2]);
                }
            } elseif (preg_match('!HTTP/1\.\d (\d)* .!', $field)) {
                $parseRes['status'] = $field;
            } else {
                $content .= $field . "\r\n";
            }
        }
        $parseRes['content'] = $content;

        return $parseRes;
    }

    /**
     * Parse received data
     * @param string $response
     * @return mixed
     * @throws \SyException\Swoole\HttpServerException
     */
    private function parseData(string $response)
    {
        if (!$this->connected) {
            $resData = $this->parseIncomingRaw($response);
            if (!HttpServer::checkSocketAccept($this->key, Tool::getArrayVal($resData, 'Sec-Websocket-Accept', null))) {
                throw new HttpServerException('服务端签名不正确', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
            }

            $this->connected = true;
            return true;
        }

        $frame = Server::unpack($response);
        if ($frame) {
            return $frame->data;
        } else {
            throw new HttpServerException('解析数据出错', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
    }
}
