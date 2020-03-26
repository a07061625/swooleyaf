<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 8:11
 */
namespace Request;

use Swoole\Coroutine;
use SyConstant\Project;
use SyLog\Log;
use SyServer\BaseServer;
use SyTool\SyPack;
use SyTool\Tool;

class SyRequestRpc extends SyRequest
{
    /**
     * @var \SyTool\SyPack
     */
    private $syPack = null;

    public function __construct()
    {
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

    private function __clone()
    {
    }

    /**
     * @param array $data 打包数据
     * @param string $packType 打包类型 api: 接口 task: 任务
     * @return bool|string
     */
    private function getPackData(array $data, string $packType)
    {
        $params = $data['params'];
        $params['__req_id'] = BaseServer::getReqId();
        if ($packType == 'api') {
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ, [
                'api_uri' => $data['uri'],
                'api_params' => $params,
            ]);
        } else {
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => $data['command'],
                'task_params' => $params,
            ]);
        }

        $packData = $this->syPack->packData();
        $this->syPack->init();
        if ($packData === false) {
            Log::error('pack ' . $packType . ' data fail');
        }
        return $packData;
    }

    /**
     * 发送api请求
     * @param string $uri 请求uri
     * @param array $params 请求参数数组
     * @param callable|null $callback
     * @return bool|string
     */
    public function sendApiReq(string $uri, array $params, callable $callback = null)
    {
        $packData = $this->getPackData([
            'uri' => $uri,
            'params' => $params,
        ], 'api');
        if (is_bool($packData)) {
            return $packData;
        }
        if ($this->_async) {
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
    public function sendTaskReq(string $command, array $params, callable $callback = null)
    {
        $packData = $this->getPackData([
            'command' => $command,
            'params' => $params,
        ], 'task');
        if (is_bool($packData)) {
            return $packData;
        }

        return $this->sendAsyncReq($packData, $callback);
    }

    /**
     * 发送同步请求
     * @param string $reqData 请求数据
     * @return bool|string
     */
    private function sendSyncReq(string $reqData)
    {
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
    private function sendAsyncReq(string $reqData, callable $callback = null) : bool
    {
        $asyncConfig = $this->getAsyncReqConfig('rpc');
        Coroutine::create(function (array $asyncConfig, string $reqData, ?callable $callback = null) {
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
            $coroutinePack = new SyPack();
            if (!$coroutinePack->unpackData($data)) {
                Log::error('unpack response data fail.');
                return 1;
            }

            $command = $coroutinePack->getCommand();
            $rspData = $coroutinePack->getData();
            if ($command != SyPack::COMMAND_TYPE_RPC_SERVER_SEND_RSP) {
                Log::error('pack data error,command=' . $command . ' data=' . Tool::jsonEncode($rspData, JSON_UNESCAPED_UNICODE));
                return 1;
            }
            if (is_callable($callback)) {
                $callback($rspData);
            }
            return 0;
        }, $asyncConfig, $reqData, $callback);
        return true;
    }
}
