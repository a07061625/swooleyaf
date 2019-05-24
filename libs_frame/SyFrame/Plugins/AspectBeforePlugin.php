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
use Reflection\BaseReflect;
use Yaf\Plugin_Abstract;
use Yaf\Registry;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class AspectBeforePlugin extends Plugin_Abstract
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
        }

        $controller = $controllerName . 'Controller';
        $action = $actionName  . 'Action';
        $aspectList = BaseReflect::getControllerAspectAnnotations($controller, $action);
        $needStr = hash('crc32b', $aspectKey);
        $aspectBeforeTag = Server::REGISTRY_NAME_PREFIX_ASPECT_BEFORE . $needStr;
        $aspectAfterTag = Server::REGISTRY_NAME_PREFIX_ASPECT_AFTER . $needStr;
        $this->aspectMap[$aspectKey] = $aspectBeforeTag;
        Registry::set($aspectBeforeTag, $aspectList['before']);
        Registry::set($aspectAfterTag, $aspectList['after']);
        return $aspectList['before'];
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();
        $aspectList = $this->getAspectList($controllerName, $actionName);

        $_SERVER['SYACTION_START'] = microtime(true);
        $logStr = $controllerName . 'Controller::' . $actionName . 'Action enter' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage();
        Log::log($logStr);
        foreach ($aspectList as $aspectName) {
            $aspectName::handleBefore();
        }
    }
}
