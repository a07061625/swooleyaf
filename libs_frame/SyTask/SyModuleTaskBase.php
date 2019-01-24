<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-11-14
 * Time: 下午7:06
 */
namespace SyTask;

use Constant\Project;
use Tool\SyPack;
use Tool\Tool;

abstract class SyModuleTaskBase {
    /**
     * @var \Tool\SyPack
     */
    protected $syPack = null;
    /**
     * @var string
     */
    protected $moduleTag = '';

    public function __construct() {
        $this->syPack = new SyPack();
    }

    private function __clone() {
    }

    public function sendSyHttpReq(string $url,array $params,$method='GET') {
        $sendUrl = $url;
        if(($method == 'GET') && !empty($params)){
            $sendUrl .= '?' . http_build_query($params);
        }
        $curlConfigs = [
            CURLOPT_URL => $sendUrl,
            CURLOPT_TIMEOUT_MS => 2000,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_HEADER => false,
            CURLOPT_RETURNTRANSFER => true,
        ];
        if($method == 'POST'){
            $curlConfigs[CURLOPT_POST] = true;
            $curlConfigs[CURLOPT_POSTFIELDS] = http_build_query($params);
        }
        $sendRes = Tool::sendCurlReq($curlConfigs);

        return $sendRes['res_no'] == 0 ? $sendRes['res_content'] : false;
    }

    public function sendSyTaskReq(string $host,int $port,string $taskStr,string $protocol) {
        if ($protocol == 'http') {
            $url = 'http://' . $host . ':' . $port;
            Tool::sendSyHttpTaskReq($url, $taskStr);
        } else {
            Tool::sendSyRpcReq($host, $port, $taskStr);
        }
    }

    protected function clearLocalUserCache(array $data,string $moduleTag) {
        if(strlen($moduleTag) == 0){
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE,
                'task_params' => [],
            ]);
            $apiTaskStr = $this->syPack->packData();
            $this->syPack->init();
            foreach ($data['projects'] as $eProject) {
                $this->sendSyTaskReq($eProject['host'], $eProject['port'], $apiTaskStr, 'rpc');
            }
        } else {
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
                'task_module' => $moduleTag,
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_USER_CACHE,
                'task_params' => [],
            ]);
            $apiTaskStr = $this->syPack->packData();
            $this->syPack->init();
            foreach ($data['projects'] as $eProject) {
                $this->sendSyTaskReq($eProject['host'], $eProject['port'], $apiTaskStr, 'http');
            }
        }
    }

    protected function clearLocalWxCache(array $data,string $moduleTag) {
        if(strlen($moduleTag) == 0){
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ, [
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $apiTaskStr = $this->syPack->packData();
            $this->syPack->init();
            foreach ($data['projects'] as $eProject) {
                $this->sendSyTaskReq($eProject['host'], $eProject['port'], $apiTaskStr, 'rpc');
            }
        } else {
            $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
                'task_module' => $moduleTag,
                'task_command' => Project::TASK_TYPE_CLEAR_LOCAL_WX_CACHE,
                'task_params' => [],
            ]);
            $apiTaskStr = $this->syPack->packData();
            $this->syPack->init();
            foreach ($data['projects'] as $eProject) {
                $this->sendSyTaskReq($eProject['host'], $eProject['port'], $apiTaskStr, 'http');
            }
        }
    }
}