<?php
/**
 * MYSQL数据库连接类
 * User: 姜伟
 * Date: 2017/1/3 0003
 * Time: 12:18
 */

namespace DesignPatterns\Singletons;

use DB\Connectors\MysqlConnect;
use SyTool\Tool;
use SyTrait\SingletonTrait;

class MysqlSingleton
{
    use SingletonTrait;

    /**
     * 连接对象列表
     *
     * @var array
     */
    private $connections = [];

    private function __construct()
    {
    }

    /**
     * @return \DesignPatterns\Singletons\MysqlSingleton
     */
    public static function getInstance(): self
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param string $dbTag 数据库标识
     */
    public function getConn(string $dbTag): \PDO
    {
        $conn = $this->getConnection($dbTag);

        return $conn->getConn();
    }

    /**
     * @param string $dbTag 数据库标识
     */
    public function getDbName(string $dbTag): string
    {
        $conn = $this->getConnection($dbTag);

        return $conn->getDbName();
    }

    /**
     * @param string $dbTag 数据库标识
     */
    public function getConnection(string $dbTag): ?MysqlConnect
    {
        $conn = Tool::getArrayVal($this->connections, $dbTag, null);
        if (null === $conn) {
            $conn = new MysqlConnect($dbTag);
            $this->connections[$dbTag] = $conn;
        }

        return $conn;
    }

    /**
     * 获取数据库的所有表名
     *
     * @param string $dbTag 数据库标识
     */
    public function getDbTables(string $dbTag): array
    {
        $conn = $this->getConnection($dbTag);

        return $conn->getDbTables();
    }

    /**
     * 获取数据表的结构描述
     *
     * @param string $dbTag     数据库标识
     * @param string $tableName 表名
     */
    public function getTableFields(string $dbTag, string $tableName): array
    {
        $conn = $this->getConnection($dbTag);

        return $conn->getTableFields($tableName);
    }

    /**
     * 获取数据表的索引
     *
     * @param string $dbTag     数据库标识
     * @param string $tableName 表名
     */
    public function getTableIndex(string $dbTag, string $tableName): array
    {
        $conn = $this->getConnection($dbTag);

        return $conn->getTableIndex($tableName);
    }

    /**
     * 检测连接
     */
    public function reConnect()
    {
        foreach ($this->connections as $tag => $connection) {
            $connection->reConnect();
        }
    }
}
