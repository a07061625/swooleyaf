<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/29 0029
 * Time: 9:48
 */
namespace SyFrame\Plugins;

use Log\Log;
use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class ActionLogPlugin extends Plugin_Abstract
{
    /**
     * 请求开始毫秒级时间戳
     * @var float
     */
    private $reqStartTime = 0.00;

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
     */
    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response)
    {
        $this->reqStartTime = microtime(true);
        $logStr = $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action enter' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage();
        Log::log($logStr);
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response)
    {
        $logStr = $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action exit' . PHP_EOL
                  . 'memory_usage: ' . memory_get_usage() . PHP_EOL
                  . 'use_time: ' . (microtime(true) - $this->reqStartTime) . 's';
        Log::log($logStr);
    }
}
