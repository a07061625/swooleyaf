<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/24 0024
 * Time: 22:11
 */
namespace SyFrame\Plugins;

use Constant\Server;
use Log\Log;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class AspectAfterPlugin extends Plugin_Abstract
{
    /**
     * 切面标识数组
     * @var array
     */
    private $aspectMap = [];

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    private function getAspectList(string $controllerName, string $actionName)
    {
        $aspectKey = strtolower($controllerName . $actionName);
        $aspectTag = $this->aspectMap[$aspectKey] ?? null;
        if (is_string($aspectTag)) {
            return Registry::get($aspectTag);
        } else {
            $aspectTag = Server::REGISTRY_NAME_PREFIX_ASPECT_AFTER . hash('crc32b', $aspectKey);
            $this->aspectMap[$aspectKey] = $aspectTag;
            return Registry::get($aspectTag);
        }
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();
        $aspectList = $this->getAspectList($controllerName, $actionName);
        foreach ($aspectList as $aspectName) {
            $aspectName::handleAfter();
        }

        $logStr = $controllerName . 'Controller::' . $actionName . 'Action exit' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage() . PHP_EOL
                  . 'use_time: ' . (microtime(true) - $_SERVER['SYACTION_START']) . 's';
        Log::log($logStr);
    }
}
