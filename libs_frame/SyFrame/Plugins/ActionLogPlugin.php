<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/29 0029
 * Time: 9:48
 */
namespace SyFrame\Plugins;

use Yaf\Plugin_Abstract;
use Yaf\Request_Abstract;
use Yaf\Response_Abstract;

class ActionLogPlugin extends Plugin_Abstract {
    /**
     * 请求开始毫秒级时间戳
     * @var float
     */
    private $reqStartTime = 0.00;
    /**
     * 日志内容前缀
     * @var string
     */
    private $preLogContent = '';

    public function __construct(){
        $this->preLogContent = SY_SERVER_IP . ' | ' . SY_MODULE . ' | ' . PHP_EOL;
    }

    private function __clone(){
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function dispatchLoopStartup(Request_Abstract $request, Response_Abstract $response){
        $this->reqStartTime = microtime(true);
        \SeasLog::info($this->preLogContent . $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action start,memory:' . memory_get_usage());
    }

    /**
     * @param \Yaf\Request_Abstract $request
     * @param \Yaf\Response_Abstract $response
     * @return void
     */
    public function dispatchLoopShutdown(Request_Abstract $request, Response_Abstract $response){
        \SeasLog::info($this->preLogContent . $request->getControllerName() . 'Controller::' . $request->getActionName() . 'Action end,memory:' . memory_get_usage() . ',time:' . (microtime(true) - $this->reqStartTime));
    }
}