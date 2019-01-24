<?php
/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends \Yaf\Bootstrap_Abstract {
    /**
     * 首次请求标识,true:首次请求 false:非首次请求
     * @var bool
     */
    private static $firstTag = true;

    private function __clone() {
    }

    public function _initBoot(\Yaf\Dispatcher $dispatcher) {
        if(self::$firstTag){
            \SyFrame\BaseBootstarp::initBase($dispatcher);

            //设置路由
            $dispatcher->getRouter()->addRoute(\Constant\Server::ROUTE_TYPE_BASIC, new \SyFrame\Routes\BasicRoute());

            //设置插件
            $dispatcher->registerPlugin(new \SyFrame\Plugins\MethodExistPlugin());
            $dispatcher->registerPlugin(new \SyFrame\Plugins\CheckConnectPlugin());
            $dispatcher->registerPlugin(new \SyFrame\Plugins\ValidatorPlugin());
            $dispatcher->registerPlugin(new \SyFrame\Plugins\FinishServicePlugin());
            $dispatcher->registerPlugin(new \SyFrame\Plugins\ActionLogPlugin());

            //设置视图
            $twigConfig = \SyFrame\BaseBootstarp::getAppConfigs('twig');
            if(empty($twigConfig)){
                throw new \Exception\Swoole\ServerException('twig配置不存在', \Constant\ErrorCode::TWIG_PARAM_ERROR);
            }

            $twigView = new \DesignPatterns\Adapters\TwigAdapter(APP_PATH . '/application/views/', $twigConfig);
            $funcList = \TemplateExtension\Twig\ProjectFunction::getInstance()->getFunction();
            foreach ($funcList as $eTag => $eFunc) {
                $twigView->addFunction($eTag, $eFunc);
            }
            $dispatcher->setView($twigView);

//            $smartyConfig = \SyFrame\BaseBootstarp::getAppConfigs('smarty');
//            if(empty($smartyConfig)){
//                throw new \Exception\Swoole\ServerException('smarty配置不存在', \Constant\ErrorCode::SMARTY_PARAM_ERROR);
//            }
//
//            $smartyView = new \DesignPatterns\Adapters\SmartyAdapter(null, $smartyConfig);
//            $dispatcher->setView($smartyView);

            self::$firstTag = false;
        }
    }
}