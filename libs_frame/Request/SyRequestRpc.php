<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:11
 */
namespace Request;

use Constant\Project;
use Log\Log;
use Tool\SyPack;
use Tool\Tool;

class SyRequestRpc extends SyRequest {
    /**
     * @var \Tool\SyPack
     */
    private $syPack = null;

    public function __construct() {
        parent::__construct();
        $this->syPack = new SyPack();
        $this->_clientConfigs = [
            'open_tcp_nodelay' => true,
            'open_length_check' => true,
            'package_length_type' => 'L',
            'package_length_offset' => 4,
            'package_body_offset' => 0,
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
        if (!$this->syPack->unpackData($rspMsg)) {
            Log::error('unpack sync response data error');
            $this->syPack->init();
            return false;
        }
        if ($this->syPack->getCommand() != SyPack::COMMAND_TYPE_RPC_SERVER_SEND_RSP) {
            Log::error('sync response data error,command=' . $this->syPack->getCommand() . ',data=' . Tool::jsonEncode($this->syPack->getData(), JSON_UNESCAPED_UNICODE));
            $this->syPack->init();
            return false;
        }

        $rspData = $this->syPack->getData();
        $this->syPack->init();

        return $rspData['rsp_data'];
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
            if ($this->syPack->unpackData($data)) {
                $command = $this->syPack->getCommand();
                $rspData = $this->syPack->getData();
                if ($command == SyPack::COMMAND_TYPE_RPC_SERVER_SEND_RSP) {
                    if (($rspData !== false) && (!is_null($callback)) && is_callable($callback)) {
                        $callback('success', $rspData['rsp_data']);
                    }
                } else {
                    Log::error('pack data error,command=' . $command . ' data=' . Tool::jsonEncode($rspData, JSON_UNESCAPED_UNICODE));
                }
            } else {
                Log::error('unpack response data fail.');
            }

            $this->syPack->init();
            $cli->close();
        });

        if(!@$this->_asyncClient->connect($this->_host, $this->_port, $this->_timeout / 1000)){
            Log::error('rpc async connect address ' . $this->_host . ':' . $this->_port . ' fail' . ',error_code:' . $this->_asyncClient->errCode . ',error_msg:' . socket_strerror($this->_asyncClient->errCode));
            return false;
        }

        return true;
    }

    /**
     * 发送api请求
     * @param string $uri 请求uri
     * @param array $params 请求参数数组
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendApiReq(string $uri,array $params,callable $callback=null) {
        $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ, [
            'api_uri' => $uri,
            'api_params' => $params,
        ]);
        $packData = $this->syPack->packData();
        $this->syPack->init();
        if ($packData === false) {
            Log::error('pack api data fail');
            return false;
        }

        if($this->_async){
            return $this->sendAsyncReq($packData, $callback);
        } else {
            return $this->sendSyncReq($packData);
        }
    }

    /**
     * 发送task请求
     * @param string $command task命令
     * @param array $params 请求参数数组
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendTaskReq(string $command,array $params,callable $callback=null) {
        $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
            'task_command' => $command,
            'task_params' => $params,
        ]);
        $packData = $this->syPack->packData();
        $this->syPack->init();
        if ($packData === false) {
            Log::error('pack task data fail');
            return false;
        }

        return $this->sendAsyncReq($packData, $callback);
    }
}