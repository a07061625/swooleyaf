<?php
/**
 * Created by PhpStorm.
 * User: jw
 * Date: 17-8-22
 * Time: 下午9:24
 */

namespace SyModule;

use DesignPatterns\Factories\CacheSimpleFactory;
use Request\SyRequestRpc;
use Response\SyResponse;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyConstant\SyInner;
use SyException\Swoole\ServerException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SimpleTrait;

abstract class ModuleRpc extends ModuleBase
{
    use SimpleTrait;

    /**
     * @var \Request\SyRequestRpc
     */
    private $syRequest;
    /**
     * 熔断器状态
     *
     * @var string
     */
    private $fuseState = '';
    /**
     * 熔断器标识
     *
     * @var string
     */
    private $fuseKey = '';
    /**
     * 熔断器半开状态请求成功数量
     *
     * @var int
     */
    private $numFuseHalfSuccess = 0;
    /**
     * 熔断器请求失败次数
     *
     * @var int
     */
    private $numFuseReqError = 0;

    /**
     * 发送api请求
     *
     * @param string        $uri      请求uri
     * @param array         $params   请求参数数组
     * @param bool          $async    是否异步 true:异步 false:同步
     * @param null|callable $callback 回调函数
     *
     * @return bool|string
     *
     * @throws \SyException\Swoole\ServerException
     */
    public function sendApiReq(string $uri, array $params, bool $async = false, ?callable $callback = null)
    {
        $checkRes = $this->checkFuseState();
        if (\strlen($checkRes) > 0) {
            return $checkRes;
        }

        $this->syRequest->init('rpc');
        $this->syRequest->setAsync($async);
        $serverInfo = $this->getRpcServerInfo();
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
        $apiRsp = $this->syRequest->sendApiReq($uri, $params, $callback);
        $this->refreshFuseState($apiRsp);
        if (false === $apiRsp) {
            Log::error('send api req fail: uri=' . $uri . '; params=' . Tool::jsonEncode($params));

            throw new ServerException('发送请求失败', ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
        }

        return $this->handlerRespContent($apiRsp);
    }

    /**
     * 发送TASK请求
     *
     * @param string        $command  task任务命令
     * @param array         $params   请求参数数组
     * @param null|callable $callback 回调函数
     *
     * @return bool|string
     *
     * @throws \SyException\Swoole\ServerException
     */
    public function sendTaskReq(string $command, array $params, ?callable $callback = null)
    {
        $this->syRequest->init('rpc');
        $this->syRequest->setAsync(true);
        $serverInfo = $this->getRpcServerInfo();
        $this->syRequest->setHost($serverInfo['host']);
        $this->syRequest->setPort($serverInfo['port']);
        $this->syRequest->setTimeout(Project::TIME_EXPIRE_SWOOLE_CLIENT_RPC);
        $content = $this->syRequest->sendTaskReq($command, $params, $callback);
        if (false === $content) {
            Log::error('send task req fail: command=' . $command . ' params=' . Tool::jsonEncode($params, JSON_UNESCAPED_UNICODE));

            throw new ServerException('发送请求失败', ErrorCode::SWOOLE_SERVER_REQUEST_FAIL);
        }

        return $this->handlerRespContent($content);
    }

    protected function init()
    {
        parent::init();
        $this->syRequest = new SyRequestRpc();
        $this->fuseState = SyInner::FUSE_STATE_CLOSED;
        $this->fuseKey = Project::YAC_PREFIX_FUSE . hash('crc32b', $this->moduleBase);
        $this->numFuseHalfSuccess = 0;
        $this->numFuseReqError = 0;
    }

    private function handlerRespContent(string $respContent): string
    {
        $contentArr = Tool::jsonDecode($respContent);
        if (!\is_array($contentArr)) {
            return $respContent;
        }

        if (isset($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_HEADERS])) {
            SyResponse::headers($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_HEADERS]);
        }
        if (isset($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_COOKIES])) {
            SyResponse::cookies($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_COOKIES]);
        }

        if (isset($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_STRING])) {
            return $contentArr[Project::DATA_KEY_RESPONSE_CONTENT_STRING];
        }
        unset($contentArr[Project::DATA_KEY_RESPONSE_CONTENT_HEADERS], $contentArr[Project::DATA_KEY_RESPONSE_CONTENT_COOKIES]);

        return Tool::jsonEncode($contentArr, JSON_UNESCAPED_UNICODE);
    }

    /**
     * 检测熔断器状态
     */
    private function checkFuseState(): string
    {
        $checkRes = '';
        if (SyInner::FUSE_STATE_OPEN == $this->fuseState) {
            $cacheData = CacheSimpleFactory::getYacInstance()->get($this->fuseKey);
            if (false === $cacheData) {
                $this->fuseState = SyInner::FUSE_STATE_HALF_OPEN;
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            } else {
                $checkRes = SyInner::FUSE_MSG_REQUEST_ERROR;
            }
        }

        return $checkRes;
    }

    /**
     * 更新熔断器状态
     *
     * @param bool|string $rspContent 响应内容
     */
    private function refreshFuseState($rspContent)
    {
        if (false !== $rspContent) {
            if (SyInner::FUSE_STATE_HALF_OPEN == $this->fuseState) {
                ++$this->numFuseHalfSuccess;
                if ($this->numFuseHalfSuccess >= SyInner::FUSE_NUM_HALF_REQUEST_SUCCESS) {
                    $this->fuseState = SyInner::FUSE_STATE_CLOSED;
                    $this->numFuseReqError = 0;
                    $this->numFuseHalfSuccess = 0;
                }
            }
        } elseif (SyInner::FUSE_STATE_CLOSED == $this->fuseState) {
            $cacheData = CacheSimpleFactory::getYacInstance()->get($this->fuseKey);
            if (false === $cacheData) {
                CacheSimpleFactory::getYacInstance()->set($this->fuseKey, 1, SyInner::FUSE_TIME_ERROR_STAT);
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            }

            ++$this->numFuseReqError;
            if ($this->numFuseReqError >= SyInner::FUSE_NUM_REQUEST_ERROR) {
                $this->fuseState = SyInner::FUSE_STATE_OPEN;
                $this->numFuseReqError = 0;
                $this->numFuseHalfSuccess = 0;
            }
        } elseif (SyInner::FUSE_STATE_HALF_OPEN == $this->fuseState) {
            CacheSimpleFactory::getYacInstance()->set($this->fuseKey, 1, SyInner::FUSE_TIME_OPEN_KEEP);
            $this->fuseState = SyInner::FUSE_STATE_OPEN;
            $this->numFuseReqError = 0;
            $this->numFuseHalfSuccess = 0;
        }
    }
}
