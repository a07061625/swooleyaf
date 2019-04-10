<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/8/22 0022
 * Time: 18:17
 */
namespace SyModule;

use Constant\Project;
use Log\Log;
use Request\SyRequestHttp;
use Tool\SyPack;
use Tool\Tool;
use Traits\SimpleTrait;

abstract class ModuleHttp extends ModuleBase {
    use SimpleTrait;

    /**
     * @var \Tool\SyPack
     */
    private $syPack = null;
    /**
     * @var \Request\SyRequestHttp
     */
    private $syRequest = null;

    protected function init() {
        parent::init();
        $this->syPack = new SyPack();
        $this->syRequest = new SyRequestHttp();
    }

    /**
     * 发送GET请求
     * @param string $uri 请求uri
     * @param array $params 请求参数数组
     * @param bool $async 是否异步 true:异步 false:同步
     * @param callable $callback 回调函数
     * @return bool|string
     */
    public function sendGetReq(string $uri,array $params,bool $async=false,callable $callback=null) {
        $this->syRequest->init('http');
        $this->syRequest->setAsync($async);
        $serverInfo = $this->getHttpServerInfo($uri, $params);
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_HTTP);
        $content = $this->syRequest->sendGetReq($serverInfo['url'], $callback);
        if($content === false){
            Log::error('send get req fail; url=' . $serverInfo['url']);
        }

        return $content;
    }

    /**
     * 发送POST请求
     * @param string $uri 请求uri
     * @param array $params 请求参数数组
     * @param bool $async 是否异步 true:异步 false:同步
     * @param callable $callback 回调函数
     * @return bool|string
     */
    public function sendPostReq(string $uri,array $params,bool $async=false,callable $callback=null) {
        $this->syRequest->init('http');
        $this->syRequest->setAsync($async);
        $serverInfo = $this->getHttpServerInfo($uri, []);
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_HTTP);
        $content = $this->syRequest->sendPostReq($serverInfo['url'], $params, $callback);
        if($content === false){
            Log::error('send post req fail: url=' . $serverInfo['url'] . '; params=' . Tool::jsonEncode($params));
        }

        return $content;
    }

    /**
     * 发送TASK请求
     * @param string $command task任务命令
     * @param array $params 请求参数数组
     * @param callable $callback 回调函数
     * @return bool|string
     */
    public function sendTaskReq(string $command,array $params,callable $callback=null) {
        $this->syPack->setCommandAndData(SyPack::COMMAND_TYPE_SOCKET_CLIENT_SEND_TASK_REQ, [
            'task_module' => $this->moduleName,
            'task_command' => $command,
            'task_params' => $params,
        ]);
        $packData = $this->syPack->packData();
        $this->syPack->init();
        if($packData === false){
            Log::error('task pack data error.command=' . $command . ' params=' . Tool::jsonEncode($params, JSON_UNESCAPED_UNICODE));
            return false;
        }

        $this->syRequest->init('http');
        $this->syRequest->setAsync(true);
        $serverInfo = $this->getHttpServerInfo('/', []);
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_HTTP);
        $content = $this->syRequest->sendTaskReq($serverInfo['url'], $packData, $callback);
        if($content === false){
            Log::error('send task req fail: url=' . $serverInfo['url']);
        }

        return $content;
    }
}