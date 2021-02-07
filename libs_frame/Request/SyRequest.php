<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:09
 */

namespace Request;

use Swoole\Client;
use SyConstant\ErrorCode;
use SyConstant\SyInner;
use SyException\Swoole\ServerException;
use SyLog\Log;
use Yaf\Registry;

abstract class SyRequest
{
    /**
     * 请求主机地址
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
     * 异步标识 true:异步 false:同步
     *
     * @var bool
     */
    protected $_async = false;
    /**
     * 超时时间，单位为毫秒
     *
     * @var int
     */
    protected $_timeout = 0;
    /**
     * 客户端配置数组
     *
     * @var array
     */
    protected $_clientConfigs = [];

    public function __construct()
    {
    }

    public function getHost(): string
    {
        return $this->_host;
    }

    /**
     * @throws \SyException\Swoole\ServerException
     */
    public function setHost(string $host)
    {
        if (\strlen($host) > 0) {
            $this->_host = $host;
        } else {
            throw new ServerException('域名不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
    }

    public function getPort(): int
    {
        return $this->_port;
    }

    /**
     * @throws \SyException\Swoole\ServerException
     */
    public function setPort(int $port)
    {
        if (($port > SyInner::ENV_PORT_MIN) && ($port < SyInner::ENV_PORT_MAX)) {
            $this->_port = $port;
        } else {
            throw new ServerException('端口不合法', ErrorCode::SWOOLE_SERVER_PARAM_ERROR);
        }
    }

    public function setAsync(bool $async)
    {
        $this->_async = $async;
    }

    public function isAsync(): bool
    {
        return $this->_async;
    }

    public function getTimeout(): int
    {
        return $this->_timeout;
    }

    /**
     * @param int $timeout 超时时间,单位为毫秒
     *
     * @throws \SyException\Swoole\ServerException
     */
    public function setTimeout(int $timeout)
    {
        if ($timeout >= 3000) {
            $this->_timeout = $timeout;
        } else {
            throw new ServerException('客户端请求超时时间不能低于3秒', ErrorCode::COMMON_SERVER_ERROR);
        }
    }

    public function init(string $protocol)
    {
        $this->_host = '';
        $this->_async = false;
        $this->_timeout = 3000;
        if ('http' == $protocol) {
            $this->_port = 80;
        } else {
            $this->_port = 0;
        }
    }

    /**
     * 获取请求参数
     *
     * @param mixed $key     键名
     * @param mixed $default 默认值
     *
     * @return array|mixed
     */
    public static function getParams(?string $key = null, $default = null)
    {
        if (null === $key) {
            $val = array_merge($_GET, $_POST);
        } elseif (isset($_GET[$key])) {
            $val = $_GET[$key];
        } elseif (isset($_POST[$key])) {
            $val = $_POST[$key];
        } else {
            $val = $default;
        }

        return $val;
    }

    /**
     * 请求参数是否存在
     *
     * @param string $key 键名
     *
     * @return bool true:存在 false:不存在
     */
    public static function existParam(string $key): bool
    {
        if (null === $key) {
            return false;
        }
        if (isset($_GET[$key])) {
            return true;
        }
        if (isset($_POST[$key])) {
            return true;
        }

        return false;
    }

    /**
     * 发送同步请求
     *
     * @param string $reqData 请求数据
     *
     * @return bool|string
     */
    protected function sendBaseSyncReq(string $reqData)
    {
        $rspMsg = false;
        $connectTag = false;
        $dataLength = \strlen($reqData);
        //为了处理Resource temporarily unavailable [11]问题,循环三次发送
        $partMsg = ' sync address ' . $this->_host . ':' . $this->_port . ' fail';
        $loopNum = 3;
        while ($loopNum > 0) {
            try {
                $client = new Client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);
                $client->set($this->_clientConfigs);
                $client->connect($this->_host, $this->_port, $this->_timeout / 1000);
                if (0 == $client->errCode) {
                    $connectTag = true;
                } else {
                    $errMsg = 'connect' . $partMsg .
                              ',error_code:' . $client->errCode .
                              ',error_msg:' . socket_strerror($client->errCode);

                    throw new ServerException($errMsg, ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
                }

                $sendLength = $client->send($reqData);
                if ($client->errCode > 0) {
                    $errMsg = 'send data to' . $partMsg .
                              ',error_code:' . $client->errCode .
                              ',error_msg:' . socket_strerror($client->errCode);

                    throw new ServerException($errMsg, ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
                }
                if ($sendLength != $dataLength) {
                    $errMsg = 'send data to' . $partMsg . ',error_msg: lose some data';

                    throw new ServerException($errMsg, ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
                }

                $rspMsg = $client->recv();
                if ($client->errCode > 0) {
                    $errMsg = 'get response from' . $partMsg .
                              ',error_code:' . $client->errCode .
                              ',error_msg:' . socket_strerror($client->errCode);

                    throw new ServerException($errMsg, ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage(), ErrorCode::SWOOLE_SERVER_REQUEST_FAIL, $e->getTraceAsString());
                Registry::del(SyInner::REGISTRY_NAME_SERVICE_ERROR);
                $rspMsg = false;
            } finally {
                if ($connectTag) {
                    $client->close();
                    $connectTag = false;
                }
            }
            if (false !== $rspMsg) {
                break;
            }

            --$loopNum;
        }

        return $rspMsg;
    }

    /**
     * 获取异步请求配置
     */
    protected function getAsyncReqConfig(): array
    {
        return [
            'request' => [
                'host' => $this->_host,
                'port' => $this->_port,
                'timeout' => $this->_timeout,
            ],
            'client' => $this->_clientConfigs,
        ];
    }
}
