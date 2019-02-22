<?php
/**
 * 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
class Bootstrap extends \SyFrame\SimpleBootstrap {
    private function __clone() {
    }

    public function _initBoot(\Yaf\Dispatcher $dispatcher) {
        if(self::$firstTag){
            $this->universalInit($dispatcher);

            //设置视图
            $twigConfig = self::getAppConfigs('twig');
            if(empty($twigConfig)){
                throw new \Exception\Swoole\ServerException('twig配置不存在', \Constant\ErrorCode::TWIG_PARAM_ERROR);
            }

            $twigView = new \DesignPatterns\Adapters\TwigAdapter(APP_PATH . '/application/views/', $twigConfig);
            $funcList = \TemplateExtension\Twig\ProjectFunction::getInstance()->getFunction();
            foreach ($funcList as $eTag => $eFunc) {
                $twigView->addFunction($eTag, $eFunc);
            }
            $dispatcher->setView($twigView);

//            $smartyConfig = self::getAppConfigs('smarty');
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