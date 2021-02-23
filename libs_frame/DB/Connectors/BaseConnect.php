<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/2/23 0023
 * Time: 14:15
 */

namespace DB\Connectors;

/**
 * Class BaseConnect
 *
 * @package DB\Connectors
 */
abstract class BaseConnect
{
    /**
     * 数据库标识
     *
     * @var string
     */
    protected $dbTag = '';
    /**
     * 数据库名称
     *
     * @var string
     */
    protected $dbName = '';
    /**
     * 连接时间戳
     *
     * @var int
     */
    protected $connTime = 0;
    /**
     * 连接PDO对象
     *
     * @var \PDO
     */
    protected $conn;

    public function __construct(string $dbTag)
    {
        $this->dbTag = $dbTag;
    }

    public function getDbTag(): string
    {
        return $this->dbTag;
    }

    public function getDbName(): string
    {
        return $this->dbName;
    }

    /**
     * @return \PDO
     */
    public function getConn(): ?\PDO
    {
        return $this->conn;
    }

    /**
     * 初始化连接
     */
    abstract protected function initConn(): bool;
}
