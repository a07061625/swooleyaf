<?php
/**
 * redis单例类
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:32
 */

namespace DesignPatterns\Singletons;

use SyConstant\ErrorCode;
use SyException\Redis\RedisException;
use SyLog\Log;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class RedisSingleton
{
    use SingletonTrait;

    /**
     * 数据库索引
     *
     * @var int
     */
    private $dbIndex = 0;
    /**
     * 客户端连接名称
     *
     * @var string
     */
    private $clientName = '';
    /**
     * @var \Redis
     */
    private $conn;
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
        if (null !== $this->conn) {
            $this->conn->close();
        }
        self::$instance = null;
    }

    /**
     * @return \DesignPatterns\Singletons\RedisSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \Redis
     */
    public function getConn(): ?\Redis
    {
        return $this->conn;
    }

    /**
     * 切换数据库
     *
     * @param int $dbIndex 数据库索引
     *
     * @throws \SyException\Redis\RedisException
     */
    public function changeDb(int $dbIndex)
    {
        if ($dbIndex < 0) {
            throw new RedisException('数据库索引不合法', ErrorCode::REDIS_CONNECTION_ERROR);
        }

        $this->getCurrentDb();
        if ($dbIndex != $this->dbIndex) {
            if (!$this->conn->select($dbIndex)) {
                throw new RedisException('切换数据库失败', ErrorCode::REDIS_CONNECTION_ERROR);
            }

            $this->dbIndex = $dbIndex;
        }
    }

    /**
     * 获取当前数据库索引
     *
     * @return int
     */
    public function getCurrentDb()
    {
        if (\strlen($this->clientName) > 0) {
            $clients = $this->conn->client('list');
            foreach ($clients as $eClient) {
                if ($eClient['name'] == $this->clientName) {
                    if ($eClient['db'] != $this->dbIndex) {
                        $this->dbIndex = (int)$eClient['db'];
                    }

                    break;
                }
            }
        }

        return $this->dbIndex;
    }

    /**
     * 关闭连接
     */
    public function close()
    {
        $this->conn->close();
        self::$instance = null;
    }

    /**
     * 检测连接
     */
    public function checkConn()
    {
        if (null === $this->conn) {
            $this->init();
        } else {
            try {
                $res = $this->conn->ping('+PONG');
                if ('+PONG' !== $res) {
                    Log::error('redis check fail,check result is ' . $res);
                    $this->init();
                }
            } catch (\Exception $e) {
                Log::error('redis connect fail-' . $e->getMessage(), $e->getCode(), $e->getTraceAsString());
                $this->init();
            }
        }
    }

    public function reConnect()
    {
        $nowTime = time();
        if (null === $this->conn) {
            $this->init();
        } elseif ($nowTime - $this->connTime >= 15) {
            $this->conn->close();
            $this->init();
        }
    }

    /**
     * 大批量删除key
     *
     * @param string $pattern 键名表达式
     * @param int    $count   每次删除的数量,默认位100
     *
     * @return int 删除key的总数
     */
    public function delByScan(string $pattern, int $count = 100): int
    {
        if ($count <= 0) {
            return 0;
        }

        $truePattern = trim($pattern);
        if (0 == \strlen($truePattern)) {
            return 0;
        }

        $it = null;
        $delNum = 0;
        do {
            $keyList = $this->conn->scan($it, $truePattern, $count);
            if (!\is_array($keyList)) {
                continue;
            }
            if (0 == \count($keyList)) {
                continue;
            }
            foreach ($keyList as $eKey) {
                $this->conn->del($eKey);
                ++$delNum;
            }
        } while ($it > 0);

        return $delNum;
    }

    /**
     * @throws \SyException\Redis\RedisException
     */
    private function init()
    {
        $this->conn = null;
        $configs = Tool::getConfig('caches.' . SY_ENV . SY_PROJECT . '.redis');

        $host = Tool::getArrayVal($configs, 'host');
        $port = Tool::getArrayVal($configs, 'port');
        $user = Tool::getArrayVal($configs, 'user', '');
        $pwd = Tool::getArrayVal($configs, 'password', '');
        $dbIndex = (int)Tool::getArrayVal($configs, 'database_index', 0);

        try {
            $redis = new \Redis();
            if (!$redis->connect($host, $port)) {
                throw new RedisException('Redis连接出错', ErrorCode::REDIS_CONNECTION_ERROR);
            }
            if (version_compare(SY_VERSION_REDIS, '6.0.0', '<')) {
                $authRes = $redis->auth($pwd);
            } else {
                $authRes = $redis->auth(['user' => $user, 'pass' => $pwd]);
            }
            if (!$authRes) {
                throw new RedisException('Redis鉴权失败', ErrorCode::REDIS_AUTH_ERROR);
            }
            if (!$redis->select($dbIndex)) {
                throw new RedisException('Redis切换数据库出错', ErrorCode::REDIS_CONNECTION_ERROR);
            }

            $this->dbIndex = $dbIndex;
            $this->clientName = hash('crc32b', microtime(true) . Tool::createNonceStr(6));
            if (!$redis->client('setname', $this->clientName)) { //设置客户端名称
                $this->clientName = '';
            }

            $this->conn = $redis;
            $this->connTime = Tool::getNowTime();
        } catch (RedisException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

            throw new RedisException('Redis初始化出错', ErrorCode::REDIS_CONNECTION_ERROR);
        }
    }
}
