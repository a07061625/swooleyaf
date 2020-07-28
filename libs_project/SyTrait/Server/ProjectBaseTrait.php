<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-5-27
 * Time: 上午10:09
 */
namespace SyTrait\Server;

use Yaf\Application;

trait ProjectBaseTrait
{
    /**
     * @var \Yaf\Application
     */
    protected $_app;

    /**
     * 初始化应用实例
     */
    private function initApp()
    {
        $this->_app = new Application(APP_PATH . '/conf/application.ini', SY_ENV);
        $this->_app->bootstrap()->getDispatcher()->returnResponse(true);
        $this->_app->bootstrap()->getDispatcher()->autoRender(false);
    }

    private function checkServerBaseTrait()
    {
    }

    private function initTableBaseTrait()
    {
    }
}
