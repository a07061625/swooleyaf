<?php
/**
 * MemCache单例类
 * User: 姜伟
 * Date: 19-3-8
 * Time: 下午8:46
 */
namespace DesignPatterns\Singletons;

use Constant\ErrorCode;
use Exception\MemCache\MemCacheException;
use Log\Log;
use Tool\Tool;
use Traits\SingletonTrait;

class MemCacheSingleton {
    use SingletonTrait;

    /**
     * @var \Memcache
     */
    private $conn = null;
    /**
     * @var int
     */
    private $connTime = 0;

    private function __construct(){
        $this->init();
    }

    public function __destruct(){
        if(!is_null($this->conn)){
            $this->conn->close();
        }
        self::$instance = null;
    }

    private function init() {
        $this->conn = null;
        $configs = Tool::getConfig('memcache.' . SY_ENV . SY_PROJECT);

        $host = Tool::getArrayVal($configs, 'host');
        $port = Tool::getArrayVal($configs, 'port');

        try {
            $memcache = new \Memcache();
            if (!$memcache->connect($host, $port)) {
                throw new MemCacheException('Memcache连接出错', ErrorCode::MEMCACHE_CONNECTION_ERROR);
            }

            $this->conn = $memcache;
            $this->connTime = Tool::getNowTime();
        } catch (MemCacheException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

            throw new MemCacheException('Memcache初始化出错', ErrorCode::MEMCACHE_CONNECTION_ERROR);
        }
    }

    /**
     * @return \DesignPatterns\Singletons\MemCacheSingleton
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \Memcache
     */
    public function getConn() {
        return $this->conn;
    }

    /**
     * 关闭连接
     */
    public function close() {
        $this->conn->close();
        self::$instance = null;
    }

    public function reConnect() {
        $nowTime = time();
        if (is_null($this->conn)) {
            $this->init();
        } else if ($nowTime - $this->connTime >= 15) {
            $this->conn->close();
            $this->init();
        }
    }
}