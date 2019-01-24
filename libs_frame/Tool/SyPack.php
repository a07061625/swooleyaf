<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-20
 * Time: 下午8:35
 */
namespace Tool;

use Constant\ErrorCode;
use Constant\Project;
use Exception\Common\CheckException;

class SyPack {
    const COMMAND_TYPE_SOCKET_CLIENT_CLOSE = '0000'; //socket客户端命令-关闭连接
    const COMMAND_TYPE_SOCKET_CLIENT_CHECK_STATUS = '0001'; //socket客户端命令-检测连接状态
    const COMMAND_TYPE_SOCKET_CLIENT_GET_SERVER = '0002'; //socket客户端命令-获取服务端信息
    const COMMAND_TYPE_SOCKET_CLIENT_SEND_API_REQ = '0003'; //socket客户端命令-发送api请求
    const COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ = '0004'; //socket客户端命令-发送task请求
    const COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ = '1000'; //rpc客户端命令-发送api请求
    const COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ = '1001'; //rpc客户端命令-发送task请求
    const COMMAND_TYPE_RPC_SERVER_SEND_RSP = '1002'; //rpc服务端命令-发送响应

    /**
     * 支持的命令数组
     * @var array
     */
    private $commandTypes = [];
    /**
     * 命令
     * @var string
     */
    private $command = '';
    /**
     * 数据
     * @var array
     */
    private $data = [];
    /**
     * 保留字段
     * @var string
     */
    private $extend = '';

    public function __construct() {
        $this->extend = '0000';
        $this->commandTypes = [
            self::COMMAND_TYPE_SOCKET_CLIENT_CLOSE => 'setDataSocketClientClose',
            self::COMMAND_TYPE_SOCKET_CLIENT_CHECK_STATUS => 'setDataSocketClientCheckStatus',
            self::COMMAND_TYPE_SOCKET_CLIENT_GET_SERVER => 'setDataSocketClientGetServer',
            self::COMMAND_TYPE_SOCKET_CLIENT_SEND_API_REQ => 'setDataSocketClientSendApiReq',
            self::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ => 'setDataSocketClientSendTaskReq',
            self::COMMAND_TYPE_RPC_CLIENT_SEND_API_REQ => 'setDataRpcClientSendApiReq',
            self::COMMAND_TYPE_RPC_CLIENT_SEND_TASK_REQ => 'setDataRpcClientSendTaskReq',
            self::COMMAND_TYPE_RPC_SERVER_SEND_RSP => 'setDataRpcServerSendRsp',
        ];
    }

    private function __clone() {
    }

    /**
     * 初始化
     */
    public function init() {
        $this->command = '';
        $this->extend = '0000';
        $this->data = [];
    }

    /**
     * @return string
     */
    public function getCommand() : string {
        return $this->command;
    }

    /**
     * @return array
     */
    public function getData() : array {
        return $this->data;
    }

    private function setDataSocketClientClose(array $data) {
        $this->data = [];
    }

    private function setDataSocketClientCheckStatus(array $data) {
        $this->data = [];
    }

    private function setDataSocketClientGetServer(array $data) {
        $this->data = [];
    }

    private function setDataSocketClientSendApiReq(array $data) {
        $module = Tool::getArrayVal($data, 'api_module', '');
        if(!is_string($module)){
            throw new CheckException('模块名称必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        } else if(!in_array($module, Project::$totalModuleName)){
            throw new CheckException('模块不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $uri = Tool::getArrayVal($data, 'api_uri', '');
        if(!is_string($uri)){
            throw new CheckException('请求URI必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        } else if(preg_match('/^\/[0-9a-zA-Z\/]*$/', $uri) == 0){
            throw new CheckException('请求URI不合法', ErrorCode::COMMON_PARAM_ERROR);
        }

        $method = Tool::getArrayVal($data, 'api_method', '');
        if(!is_string($method)){
            throw new CheckException('请求方式必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        } else if(!in_array($method, ['GET', 'POST'])){
            throw new CheckException('请求方式不合法', ErrorCode::COMMON_PARAM_ERROR);
        }

        $params = Tool::getArrayVal($data, 'api_params', null);
        if (!is_array($params)) {
            throw new CheckException('请求数据必须是数组', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->data = [
            'api_module' => $module,
            'api_uri' => $uri,
            'api_method' => $method,
            'api_params' => $params,
        ];
    }

    private function setDataSocketClientSendTaskReq(array $data) {
        $module = Tool::getArrayVal($data, 'task_module', '');
        if(!is_string($module)){
            throw new CheckException('模块名称必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        } else if(!in_array($module, Project::$totalModuleName)){
            throw new CheckException('模块不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $taskCommand = Tool::getArrayVal($data, 'task_command', '');
        if(!is_string($taskCommand)){
            throw new CheckException('任务命令必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        }

        $params = Tool::getArrayVal($data, 'task_params', null);
        if (!is_array($params)) {
            throw new CheckException('请求数据必须是数组', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->data = [
            'task_module' => $module,
            'task_command' => $taskCommand,
            'task_params' => $params,
        ];
    }

    private function setDataRpcClientSendApiReq(array $data) {
        $uri = Tool::getArrayVal($data, 'api_uri', '');
        if(!is_string($uri)){
            throw new CheckException('请求URI必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        } else if(preg_match('/^\/[0-9a-zA-Z\/]*$/', $uri) == 0){
            throw new CheckException('请求URI不合法', ErrorCode::COMMON_PARAM_ERROR);
        }

        $params = Tool::getArrayVal($data, 'api_params', null);
        if (!is_array($params)) {
            throw new CheckException('请求数据必须是数组', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->data = [
            'api_uri' => $uri,
            'api_params' => $params,
        ];
    }

    private function setDataRpcClientSendTaskReq(array $data) {
        $taskCommand = Tool::getArrayVal($data, 'task_command', '');
        if(!is_string($taskCommand)){
            throw new CheckException('任务命令必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        }

        $params = Tool::getArrayVal($data, 'task_params', null);
        if (!is_array($params)) {
            throw new CheckException('请求数据必须是数组', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->data = [
            'task_command' => $taskCommand,
            'task_params' => $params,
        ];
    }

    private function setDataRpcServerSendRsp(array $data) {
        $rspData = Tool::getArrayVal($data, 'rsp_data', null);
        if (!is_string($rspData)) {
            throw new CheckException('响应数据必须是字符串', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->data = [
            'rsp_data' => $rspData,
        ];
    }

    /**
     * @param string $command
     * @param array $data
     * @throws \Exception\Common\CheckException
     */
    public function setCommandAndData(string $command,array $data) {
        $funcName = Tool::getArrayVal($this->commandTypes, $command, null);
        if(is_null($funcName)){
            throw new CheckException('命令不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $this->$funcName($data);
        $this->command = $command;
    }

    /**
     * @return string
     */
    public function getExtend() : string {
        return $this->extend;
    }

    /**
     * 压缩数据
     * @return bool|string
     */
    public function packData() {
        if(strlen($this->command) == 0){
            return false;
        }

        $dataStr = Tool::pack($this->data);
        if($dataStr === false){
            return false;
        }

        return pack('L2A4A4a*', 16, (strlen($dataStr) + 16), $this->command, $this->extend, $dataStr);
    }

    /**
     * 解压数据
     * @param string $dataStr
     * @return bool
     */
    public function unpackData(string $dataStr) : bool {
        $unpackRes = unpack('Lk1/Lk2/A4k3/A4k4/a*k5', $dataStr);
        if(!isset($unpackRes['k5'])){
            return false;
        }

        $data = Tool::unpack($unpackRes['k5']);
        if($data === false){
            return false;
        }

        $this->command = $unpackRes['k3'];
        $this->extend = $unpackRes['k4'];
        $this->data = $data;
        return true;
    }
}