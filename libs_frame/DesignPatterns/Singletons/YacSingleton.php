<?php
/**
 * 本地服务器缓存单例类
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:28
 */
namespace DesignPatterns\Singletons;

use Traits\SingletonTrait;

class YacSingleton  {
    use SingletonTrait;

    /**
     * @var \Yac
     */
    private $conn = null;

    private function __construct() {
        $this->conn = new \Yac(SY_ENV . SY_PROJECT . '_');
    }

    /**
     * @return \Yac
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance->conn;
    }
}