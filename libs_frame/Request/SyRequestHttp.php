<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:10
 */

namespace Request;

use Swoole\Coroutine;
use SyConstant\Project;
use SyConstant\SyInner;
use SyLog\Log;
use SyTool\HttpTool;

class SyRequestHttp extends SyRequest
{
    /**
     * 框架自定义http header名称
     *
     * @var string
     */
    private $headerName = '';

    public function __construct()
    {
        parent::__construct();
        $this->_port = 80;
        $this->headerName = ucwords(SyInner::SERVER_HTTP_TAG_REQUEST_HEADER, '-');
        $this->_clientConfigs = [
            'open_tcp_nodelay' => true,
            'open_eof_check' => true,
            'package_eof' => "\r\n\r\n",
            'package_max_length' => Project::SIZE_SERVER_PACKAGE_MAX,
            'socket_buffer_size' => Project::SIZE_CLIENT_SOCKET_BUFFER,
        ];
    }

    private function __clone()
    {
    }

    /**
     * @return bool|string
     */
    public function sendGetReq(string $url, ?callable $callback = null)
    {
        $reqHeaderStr = HttpTool::getReqHeaderStr('GET', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'text/html;charset=utf-8',
        ]);
        $reqData = $reqHeaderStr . "\r\n";

        if ($this->_async) {
            return $this->sendAsyncReq($reqData, $callback);
        }

        return $this->sendSyncReq($reqData);
    }

    /**
     * @return bool|string
     */
    public function sendPostReq(string $url, array $params, ?callable $callback = null)
    {
        $body = empty($params) ? '' : http_build_query($params);
        $reqHeaderStr = HttpTool::getReqHeaderStr('POST', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length' => \strlen($body),
        ]);
        $reqData = $reqHeaderStr . "\r\n" . $body;

        if ($this->_async) {
            return $this->sendAsyncReq($reqData, $callback);
        }

        return $this->sendSyncReq($reqData);
    }

    /**
     * 发送任务请求
     *
     * @param string $url      请求地址
     * @param string $packData 压缩后的数据字符串
     *
     * @return bool|string
     */
    public function sendTaskReq(string $url, string $packData, ?callable $callback = null)
    {
        $body = http_build_query([
            SyInner::SERVER_DATA_KEY_TASK => $packData,
        ]);
        $reqHeaderStr = HttpTool::getReqHeaderStr('POST', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length' => \strlen($body),
        ]);
        $reqData = $reqHeaderStr . "\r\n" . $body;

        return $this->sendAsyncReq($reqData, $callback);
    }

    /**
     * 发送同步请求
     *
     * @param string $reqData 请求数据
     *
     * @return bool|string
     */
    private function sendSyncReq(string $reqData)
    {
        $rspMsg = $this->sendBaseSyncReq($reqData);
        if (false === $rspMsg) {
            return false;
        }

        $rspData = HttpTool::parseResponse($rspMsg);

        return false === $rspData ? false : $rspData['body'];
    }

    /**
     * 发送异步请求
     *
     * @param string        $reqData  请求数据
     * @param null|callable $callback 回调函数
     */
    private function sendAsyncReq(string $reqData, ?callable $callback = null): bool
    {
        $asyncConfig = $this->getAsyncReqConfig();
        Coroutine::asyncReq(function (array $asyncConfig, string $reqData, ?callable $callback = null) {
            $client = new Coroutine\Client(SWOOLE_SOCK_TCP);
            $client->set($asyncConfig['client']);
            if (!$client->connect($asyncConfig['request']['host'], $asyncConfig['request']['port'], $asyncConfig['request']['timeout'] / 1000)) {
                $logStr = 'rpc async connect address '
                          . $asyncConfig['request']['host']
                          . ':'
                          . $asyncConfig['request']['port']
                          . ' fail,error_code:'
                          . $client->errCode
                          . ',error_msg:'
                          . socket_strerror($client->errCode);
                Log::error($logStr);

                return 1;
            }
            $client->send($reqData);
            $data = $client->recv();
            $client->close();
            $rspData = HttpTool::parseResponse($data);
            if (\is_callable($callback)) {
                $callback($rspData['body']);
            }

            return 0;
        }, $asyncConfig, $reqData, $callback);

        return true;
    }
}
