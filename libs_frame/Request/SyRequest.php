<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:09
 */
namespace Request;

use Constant\ErrorCode;
use Exception\Swoole\ServerException;
use Log\Log;

abstract class SyRequest {
    /**
     * 请求主机地址
     * @var string
     */
    protected $_host = '';
    /**
     * 请求端口
     * @var int
     */
    protected $_port = 0;
    /**
     * 异步标识 true:异步 false:同步
     * @var bool
     */
    protected $_async = false;
    /**
     * 超时时间，单位为毫秒
     * @var int
     */
    protected $_timeout = 0;
    /**
     * 异步客户端
     * @var \swoole_client
     */
    protected $_asyncClient = null;
    /**
     * 客户端配置数组
     * @var array
     */
    protected $_clientConfigs = [];

    public function __construct() {
    }

    /**
     * @return string
     */
    public function getHost() : string {
        return $this->_host;
    }

    /**
     * @param string $host
     * @throws \Exception\Swoole\ServerException
     */
    public function setHost(string $host) {
        $trueHost = preg_replace('/\s+/', '', $host);
        if (strlen($trueHost) > 0) {
            $this->_host = $trueHost;
        } else {
            throw new ServerException('域名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
    }

    /**
     * @return int
     */
    public function getPort() : int {
        return $this->_port;
    }

    /**
     * @param int $port
     * @throws \Exception\Swoole\ServerException
     */
    public function setPort(int $port) {
        if (($port > 1000) && ($port < 65536)) {
            $this->_port = $port;
        } else {
            throw new ServerException('端口不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
    }

    /**
     * @param bool $async
     */
    public function setAsync(bool $async) {
        $this->_async = $async;
    }

    /**
     * @return bool
     */
    public function isAsync() : bool {
        return $this->_async;
    }

    /**
     * @return int
     */
    public function getTimeout() : int {
        return $this->_timeout;
    }

    /**
     * @param int $timeout 超时时间,单位为毫秒
     * @throws \Exception\Swoole\ServerException
     */
    public function setTimeout(int $timeout) {
        if ($timeout >= 3000) {
            $this->_timeout = $timeout;
        } else {
            throw new ServerException('客户端请求超时时间不能低于3秒', ErrorCode::COMMON_SERVER_ERROR);
        }
    }

    public function init(string $protocol) {
        $this->_host = '';
        $this->_async = false;
        $this->_timeout = 3000;
        $this->_asyncClient = null;
        if ($protocol == 'http') {
            $this->_port = 80;
        } else {
            $this->_port = 0;
        }
    }

    /**
     * 获取请求参数
     * @param mixed $key 键名
     * @param mixed $default 默认值
     * @return array|mixed
     */
    public static function getParams(string $key=null, $default=null) {
        if($key === null){
            $val = array_merge($_GET, $_POST);
        } else if(isset($_GET[$key])){
            $val = $_GET[$key];
        } else if(isset($_POST[$key])){
            $val = $_POST[$key];
        } else {
            $val = $default;
        }

        return $val;
    }

    /**
     * 请求参数是否存在
     * @param string $key 键名
     * @return bool true:存在 false:不存在
     */
    public static function existParam(string $key){
        if($key === null){
            return false;
        } else if(isset($_GET[$key])){
            return true;
        } else if(isset($_POST[$key])){
            return true;
        } else {
            return false;
        }
    }

    /**
     * 发送同步请求
     * @param string $reqData 请求数据
     * @return bool|mixed
     * @throws \Exception\Swoole\ServerException
     */
    protected function sendBaseSyncReq(string $reqData) {
        if (strlen($this->_host) == 0) {
            throw new ServerException('服务端域名不能为空', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        } else if (($this->_port <= 1000) || ($this->_port > 65536)) {
            throw new ServerException('服务端端口不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }

        $client = new \swoole_client(SWOOLE_TCP, SWOOLE_SOCK_SYNC);
        $client->set($this->_clientConfigs);
        if (!@$client->connect($this->_host, $this->_port, $this->_timeout / 1000)) {
            Log::error('sync connect address ' . $this->_host . ':' . $this->_port . ' fail' . ',error_code:' . $client->errCode . ',error_msg:' . socket_strerror($client->errCode));
            return false;
        }

        if(!$client->send($reqData)){
            $client->close();
            Log::error('send sync data to address ' . $this->_host . ':' . $this->_port . ' fail,error_code:' . $client->errCode . ',error_msg:' . socket_strerror($client->errCode));
            return false;
        }

        $rspMsg = @$client->recv();
        if ($rspMsg === false) {
            Log::error('get sync response data error,error_code:' . $client->errCode . ',error_msg:' . socket_strerror($client->errCode));
        }
        $client->close();

        return $rspMsg;
    }

    protected function sendBaseAsyncReq(string $reqData,callable $callback=null) {
        $this->_asyncClient = new \swoole_client(SWOOLE_TCP, SWOOLE_SOCK_ASYNC);
        $this->_asyncClient->set($this->_clientConfigs);
        $this->_asyncClient->on('connect', function (\swoole_client $cli) use ($reqData) {
            if (!$cli->send($reqData)) {
                $socketData = $cli->getsockname();
                $log = 'send async data ';
                if (is_array($socketData) && isset($socketData['host']) && isset($socketData['port'])) {
                    $log .= $socketData['host'] . ':' . $socketData['port'];
                }
                $log .= 'fail,error_code:' . $cli->errCode . ',error_msg:' . socket_strerror($cli->errCode);
                Log::error($log);
            }
        });
        $this->_asyncClient->on('error', function (\swoole_client $cli) use ($callback) {
            Log::info('async callback error,errCode:' . $cli->errCode . ' errMsg:' . socket_strerror($cli->errCode));
            if ((!is_null($callback) && is_callable($callback))) {
                $callback('error', $cli);
            }
            $cli->close();
        });
        $this->_asyncClient->on('close', function (\swoole_client $cli) {
        });
    }
}