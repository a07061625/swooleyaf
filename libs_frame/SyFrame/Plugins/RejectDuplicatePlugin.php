<?php
/**
 * 拒绝重复请求插件
 * User: 姜伟
 * Date: 2020/10/24 0024
 * Time: 20:34
 */
namespace SyFrame\Plugins;

use DesignPatterns\Factories\CacheSimpleFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Swoole\ServerException;
use SyTool\Tool;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

/**
 * Class RejectDuplicatePlugin
 * @package SyFrame\Plugins
 */
class RejectDuplicatePlugin extends Plugin_Abstract
{
    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     * @throws \SyException\Swoole\ServerException
     */
    public function routerShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        if (isset($_SERVER['HTTP_sy-client'])) {
            $clientId = trim($_SERVER['HTTP_sy-client']);
        } else {
            $clientId = '';
        }
        if (strlen($clientId) > 0) {
            $tag = Tool::getNowTime() . strtolower($request->getMethod() . '_' . $request->getModuleName() . $request->getControllerName() . $request->getActionName());
            $cacheKey = Project::REDIS_PREFIX_DUPLICATE_REQUEST . md5($tag);
            $cacheData = CacheSimpleFactory::getRedisInstance()->incr($cacheKey);
            CacheSimpleFactory::getRedisInstance()->expire($cacheKey, 3);
            if ($cacheData > 1) {
                throw new ServerException('请勿重复发送请求', ErrorCode::COMMON_SERVER_ERROR);
            }
        }
    }
}
