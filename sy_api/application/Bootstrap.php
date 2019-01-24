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

            self::$firstTag = false;
        }
    }
}