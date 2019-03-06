<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-22
 * Time: 下午9:24
 */
namespace SyModule;

use Constant\Project;
use Constant\Server;
use DesignPatterns\Factories\CacheSimpleFactory;
use Log\Log;
use Request\SyRequestRpc;
use Tool\Tool;
use Traits\SimpleTrait;

abstract class ModuleRpc extends ModuleBase {
    use SimpleTrait;

    /**
     * @var \Request\SyRequestRpc
     */
    private $syRequest = null;
    /**
     * 熔断器状态
     * @var string
     */
    private $fuseState = '';
    /**
     * 熔断器标识
     * @var string
     */
    private $fuseKey = '';
    /**
     * 熔断器半开状态请求成功数量
     * @var int
     */
    private $numFuseHalfSuccess = 0;
    /**
     * 熔断器请求失败次数
     * @var int
     */
    private $numFuseReqError = 0;

    protected function init() {
        parent::init();
        $this->syRequest = new SyRequestRpc();
        $this->fuseState = Server::FUSE_STATE_CLOSED;
        $this->fuseKey = Server::YAC_PREFIX_FUSE . hash('crc32b', $this->moduleBase);
        $this->numFuseHalfSuccess = 0;
        $this->numFuseReqError = 0;
    }

    /**
     * 检测熔断器状态
     * @return string
     */
    private function checkFuseState() {
        $checkRes = '';
        if($this->fuseState == Server::FUSE_STATE_OPEN){
            $cacheData = CacheSimpleFactory::getYacInstance()->get($this->fuseKey);
            if($cacheData === false){
                $this->fuseState = Server::FUSE_STATE_HALF_OPEN;
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            } else {
                $checkRes = Server::FUSE_MSG_REQUEST_ERROR;
            }
        }

        return $checkRes;
    }

    /**
     * 更新熔断器状态
     * @param bool|string $rspContent 响应内容
     */
    private function refreshFuseState($rspContent) {
        if($rspContent !== false){
            if($this->fuseState == Server::FUSE_STATE_HALF_OPEN){
                $this->numFuseHalfSuccess++;
                if($this->numFuseHalfSuccess >= Server::FUSE_NUM_HALF_REQUEST_SUCCESS){
                    $this->fuseState = Server::FUSE_STATE_CLOSED;
                    $this->numFuseReqError = 0;
                    $this->numFuseHalfSuccess = 0;
                }
            }
        } else if($this->fuseState == Server::FUSE_STATE_CLOSED){
            $cacheData = CacheSimpleFactory::getYacInstance()->get($this->fuseKey);
            if($cacheData === false){
                CacheSimpleFactory::getYacInstance()->set($this->fuseKey, 1, Server::FUSE_TIME_ERROR_STAT);
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            }

            $this->numFuseReqError++;
            if($this->numFuseReqError >= Server::FUSE_NUM_REQUEST_ERROR){
                $this->fuseState = Server::FUSE_STATE_OPEN;
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            }
        } else if($this->fuseState == Server::FUSE_STATE_HALF_OPEN){
            CacheSimpleFactory::getYacInstance()->set($this->fuseKey, 1, Server::FUSE_TIME_OPEN_KEEP);
            $this->fuseState = Server::FUSE_STATE_OPEN;
            $this->numFuseReqError = 0;
            $this->numFuseHalfSuccess = 0;
        }
    }

    /**
     * 发送api请求
     * @param string $uri 请求uri
     * @param array $params 请求参数数组
     * @param bool $async 是否异步 true:异步 false:同步
     * @param callable $callback 回调函数
     * @return bool|string
     */
    public function sendApiReq(string $uri,array $params,bool $async=false,callable $callback=null) {
        $checkRes = $this->checkFuseState();
        if(strlen($checkRes) > 0){
            return $checkRes;
        }

        $this->syRequest->init('rpc');
        $this->syRequest->setAsync($async);
        $serverInfo = $this->getRpcServerInfo();
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
        $apiRsp = $this->syRequest->sendApiReq($uri, $params, $callback);
        if($apiRsp === false){
            Log::error('send api req fail: uri=' . $uri . '; params=' . Tool::jsonEncode($params));
        }
        $this->refreshFuseState($apiRsp);

        return $apiRsp;
    }

    /**
     * 发送TASK请求
     * @param string $command task任务命令
     * @param array $params 请求参数数组
     * @param callable $callback 回调函数
     * @return bool|string
     */
    public function sendTaskReq(string $command,array $params,callable $callback=null) {
        $this->syRequest->init('rpc');
        $this->syRequest->setAsync(true);
        $serverInfo = $this->getRpcServerInfo();
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
        $content = $this->syRequest->sendTaskReq($command, $params, $callback);
        if($content === false){
            Log::error('send task req fail: command=' . $command . ' params=' . Tool::jsonEncode($params, JSON_UNESCAPED_UNICODE));
        }

        return $content;
    }
}