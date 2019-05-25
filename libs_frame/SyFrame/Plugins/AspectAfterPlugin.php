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
        $this->aspectMap = [];
    }

    private function __clone()
    {
    }

    private function getAspectList(string $controllerName, string $actionName)
    {
        $aspectKey = strtolower($controllerName . $actionName);
        $aspectTag = $this->aspectMap[$aspectKey] ?? null;
        if (is_null($aspectTag)) {
            $aspectTag = hash('crc32b', $aspectKey);
            $this->aspectMap[$aspectKey] = $aspectTag;
        }
        return [
            'tag' => $aspectTag,
            'list' => Registry::get(Server::REGISTRY_NAME_PREFIX_ASPECT_AFTER . $aspectTag),
        ];
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function postDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        $controllerName = $request->getControllerName();
        $actionName = $request->getActionName();
        $aspectList = $this->getAspectList($controllerName, $actionName);
        foreach ($aspectList['list'] as $aspectName) {
            $aspectName::handleAfter();
        }

        $logStr = $controllerName . 'Controller::' . $actionName . 'Action exit' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage() . PHP_EOL
                  . 'use_time: ' . (microtime(true) - $_SERVER['SYSTART_' . $aspectList['tag']]) . 's';
        Log::log($logStr);
    }
}
