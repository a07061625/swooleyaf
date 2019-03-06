<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:10
 */
namespace Request;

use Constant\Project;
use Constant\Server;
use Log\Log;
use Tool\HttpTool;

class SyRequestHttp extends SyRequest {
    /**
     * 框架自定义http header名称
     * @var string
     */
    private $headerName = '';

    public function __construct() {
        parent::__construct();
        $this->_port = 80;
        $this->headerName = ucwords(Server::SERVER_HTTP_TAG_REQUEST_HEADER, '-');
        $this->_clientConfigs = [
            'open_tcp_nodelay' => true,
            'open_eof_check' => true,
            'package_eof' => Server::SERVER_HTTP_TAG_RESPONSE_EOF,
            'package_max_length' => Project::SIZE_SERVER_PACKAGE_MAX,
            'socket_buffer_size' => Project::SIZE_CLIENT_SOCKET_BUFFER,
        ];
    }

    private function __clone() {
    }

    /**
     * 发送同步请求
     * @param string $reqData 请求数据
     * @return bool|string
     */
    protected function sendSyncReq(string $reqData) {
        $rspMsg = $this->sendBaseSyncReq($reqData);
        if ($rspMsg === false) {
            return false;
        }

        $rspData = HttpTool::parseResponse($rspMsg);
        return $rspData === false ? false : str_replace(Server::SERVER_HTTP_TAG_RESPONSE_EOF, '', $rspData['body']);
    }

    /**
     * 发送异步请求
     * @param string $reqData 请求数据
     * @param callable|null $callback 回调函数
     * @return bool
     */
    protected function sendAsyncReq(string $reqData,callable $callback=null) : bool {
        $this->sendBaseAsyncReq($reqData, $callback);
        $this->_asyncClient->on('receive', function (\swoole_client $cli,string $data) use ($callback) {
            $rspData = HttpTool::parseResponse($data);
            if (($rspData !== false) && (!is_null($callback)) && is_callable($callback)) {
                $callback('success', str_replace(Server::SERVER_HTTP_TAG_RESPONSE_EOF, '', $rspData['body']));
            }
            $cli->close();
        });

        if(!@$this->_asyncClient->connect($this->_host, $this->_port, $this->_timeout / 1000)){
            Log::error('http async connect address ' . $this->_host . ':' . $this->_port . ' fail' . ',error_code:' . $this->_asyncClient->errCode . ',error_msg:' . socket_strerror($this->_asyncClient->errCode));
            return false;
        }

        return true;
    }

    /**
     * @param string $url
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendGetReq(string $url,callable $callback=null){
        $reqHeaderStr = HttpTool::getReqHeaderStr('GET', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'text/html;charset=utf-8',
        ]);
        $reqData = $reqHeaderStr . "\r\n";

        if($this->_async){
            return $this->sendAsyncReq($reqData, $callback);
        } else {
            return $this->sendSyncReq($reqData);
        }
    }

    /**
     * @param string $url
     * @param array $params
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendPostReq(string $url,array $params,callable $callback=null){
        $body = empty($params) ? '' : http_build_query($params);
        $reqHeaderStr = HttpTool::getReqHeaderStr('POST', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length' => strlen($body),
        ]);
        $reqData = $reqHeaderStr . "\r\n" . $body;

        if($this->_async){
            return $this->sendAsyncReq($reqData, $callback);
        } else {
            return $this->sendSyncReq($reqData);
        }
    }

    /**
     * 发送任务请求
     * @param string $url 请求地址
     * @param string $packData 压缩后的数据字符串
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendTaskReq(string $url,string $packData,callable $callback=null) {
        $body = http_build_query([
            Server::SERVER_DATA_KEY_TASK => $packData
        ]);
        $reqHeaderStr = HttpTool::getReqHeaderStr('POST', $url, [
            $this->headerName => SY_VERSION,
            'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8',
            'Content-Length' => strlen($body),
        ]);
        $reqData = $reqHeaderStr . "\r\n" . $body;

        return $this->sendAsyncReq($reqData, $callback);
    }
}