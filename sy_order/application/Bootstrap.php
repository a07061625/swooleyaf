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
            self::$firstTag = false;
        }
    }
}