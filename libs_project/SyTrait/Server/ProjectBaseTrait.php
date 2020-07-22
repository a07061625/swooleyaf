<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace SyTrait\Server;

use Swoole\Server;
use Yaf\Application;
use Yaf\Request\Http;

trait ProjectBaseTrait
{
    /**
     * @var \Yaf\Application
     */
    protected $_app = null;

    /**
     * 初始化应用实例
     */
    private function initApp()
    {
        $this->_app = new Application(APP_PATH . '/conf/application.ini', SY_ENV);
        $this->_app->bootstrap()->getDispatcher()->returnResponse(true);
        $this->_app->bootstrap()->getDispatcher()->autoRender(false);
    }

    /**
     * 处理应用请求
     * @param array $params
     * @return string
     */
    protected function handleAppRequest(array $params) : string
    {
        $httpObj = new Http($params['req_uri']);
        $result = $this->_app->bootstrap()->getDispatcher()->dispatch($httpObj)->getBody();
        unset($httpObj);

        return $result;
    }

    private function checkServerBaseTrait()
    {
    }

    private function initTableBaseTrait()
    {
    }

    private function addTaskBaseTrait(Server $server)
    {
    }

    /**
     * @param \Swoole\Server $server
     * @param int $taskId
     * @param int $fromId
     * @param array $data
     * @return string 空字符串:执行成功 非空:执行失败
     */
    private function handleTaskBaseTrait(Server $server, int $taskId, int $fromId, array &$data) : string
    {
        return '';
    }
}
