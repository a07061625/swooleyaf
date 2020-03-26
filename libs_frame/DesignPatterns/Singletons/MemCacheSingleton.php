<?php
/**
 * MemCache单例类
 * User: 姜伟
 * Date: 19-3-8
 * Time: 下午8:46
 */
namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\MemCache\MemCacheException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class MemCacheSingleton
{
    use SingletonTrait;

    /**
     * @var \Memcached
     */
    private $conn = null;
    /**
     * @var int
     */
    private $connTime = 0;

    private function __construct()
    {
        $this->init();
    }

    public function __destruct()
    {
        if (!is_null($this->conn)) {
            $this->conn->quit();
        }
        self::$instance = null;
    }

    /**
     * @return \DesignPatterns\Singletons\MemCacheSingleton
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \Memcached
     */
    public function getConn()
    {
        return $this->conn;
    }

    /**
     * 关闭连接
     */
    public function close()
    {
        $this->conn->quit();
        self::$instance = null;
    }

    public function reConnect()
    {
        $nowTime = time();
        if (is_null($this->conn)) {
            $this->init();
        } elseif ($nowTime - $this->connTime >= 15) {
            $this->conn->quit();
            $this->init();
        }
    }

    private function init()
    {
        $this->conn = null;
        $configs = Tool::getConfig('caches.' . SY_ENV . SY_PROJECT . '.memcache');

        $servers = [];
        $existServers = (array)Tool::getArrayVal($configs, 'servers', []);
        foreach ($existServers as $eServer) {
            $serverHost = trim(Tool::getArrayVal($eServer, 'host', ''));
            if (strlen($serverHost) > 0) {
                $serverPort = (int)Tool::getArrayVal($eServer, 'port', 11211);
                $serverWeight = (int)Tool::getArrayVal($eServer, 'weight', 0);
                $servers[] = [$serverHost, $serverPort, $serverWeight];
            }
        }
        unset($existServers);
        if (empty($servers)) {
            throw new MemCacheException('Memcache服务端不能为空', ErrorCode::MEMCACHE_CONNECTION_ERROR);
        }

        try {
            $memcached = new \Memcached(SY_ENV . SY_PROJECT);
            $memcached->setOptions([
                \Memcached::OPT_COMPRESSION => true,
                \Memcached::OPT_SERIALIZER => \Memcached::SERIALIZER_MSGPACK,
                \Memcached::OPT_PREFIX_KEY => '',
                \Memcached::OPT_HASH => \Memcached::HASH_DEFAULT,
                \Memcached::OPT_DISTRIBUTION => \Memcached::DISTRIBUTION_MODULA,
                \Memcached::OPT_BUFFER_WRITES => false,
                \Memcached::OPT_BINARY_PROTOCOL => false,
                \Memcached::OPT_NO_BLOCK => false,
                \Memcached::OPT_TCP_NODELAY => true,
                \Memcached::OPT_CONNECT_TIMEOUT => 1500,
                \Memcached::OPT_RETRY_TIMEOUT => 0,
                \Memcached::OPT_SEND_TIMEOUT => 2000000,
                \Memcached::OPT_RECV_TIMEOUT => 1500000,
                \Memcached::OPT_POLL_TIMEOUT => 1000,
                \Memcached::OPT_CACHE_LOOKUPS => false,
                \Memcached::OPT_SERVER_FAILURE_LIMIT => 0,
                \Memcached::OPT_REMOVE_FAILED_SERVERS => true,
                \Memcached::HAVE_MSGPACK => true,
                \Memcached::GET_PRESERVE_ORDER => true,
            ]);
            $memcached->addServers($servers);

            $this->conn = $memcached;
            $this->connTime = Tool::getNowTime();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());
            throw new MemCacheException('Memcache初始化出错', ErrorCode::MEMCACHE_CONNECTION_ERROR);
        }
    }
}
