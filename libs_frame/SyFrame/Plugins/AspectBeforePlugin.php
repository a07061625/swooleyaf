<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2019/5/24 0024
 * Time: 22:11
 */
namespace SyFrame\Plugins;

use SyLog\Log;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class AspectBeforePlugin extends Plugin_Abstract
{
    /**
     * 方法映射数组
     * @var array
     */
    private $actionMap = [];

    public function __construct()
    {
        $this->actionMap = [];
    }

    private function __clone()
    {
    }

    private function getActionTag()
    {
        $actionKey = $_SERVER['SYKEY-CA'];
        $actionTag = $this->actionMap[$actionKey] ?? null;
        if (is_string($actionTag)) {
            return $actionTag;
        } else {
            $actionTag = hash('crc32b', $actionKey);
            $this->actionMap[$actionKey] = $actionTag;
            return $actionTag;
        }
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function preDispatch(Request_Abstract $request, Response_Abstract $response)
    {
        $actionTag = $this->getActionTag();
        $_SERVER['SYSTART_' . $actionTag] = microtime(true);
        $logStr = $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action enter' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage();
        Log::log($logStr);
    }
}
