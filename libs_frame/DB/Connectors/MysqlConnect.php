<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2021/2/23 0023
 * Time: 14:32
 */

namespace DB\Connectors;

use SyConstant\ErrorCode;
use SyException\Mysql\MysqlException;
use SyLog\Log;
use SyTool\Tool;

/**
 * Class MysqlConnect
 *
 * @package DB\Connectors
 */
class MysqlConnect extends BaseConnect
{
    /**
     * 重连错误信息
     *
     * @var array
     */
    private $reconnectMessages = [];

    public function __construct(string $dbTag)
    {
        parent::__construct($dbTag);
        $this->reconnectMessages = [
            'server has gone away',
            'no connection to the server',
            'Lost connection',
            'is dead or not enabled',
            'Error while sending',
            'server closed the connection',
            'SSL connection has been closed',
            'Error writing data to the connection',
            'Resource deadlock avoided',
            'failed with errno=32 Broken pipe',
        ];
        $this->initConn();
    }

    private function __clone()
    {
    }

    /**
     * 获取所有数据库
     *
     * @param bool $filter 是否过滤mysql配置数据库，true：过滤 false：不过滤
     */
    public function getDbs(bool $filter): array
    {
        $stmt = $this->conn->query('SHOW DATABASES');
        $dbs = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        unset($stmt);
        if ($filter) {
            return array_diff($dbs, ['information_schema', 'performance_schema', 'mysql']);
        }

        return $dbs;
    }

    /**
     * 获取数据库的所有表名
     */
    public function getDbTables(): array
    {
        $stmt = $this->conn->query('SHOW TABLES');
        $tables = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        unset($stmt);

        return $tables;
    }

    /**
     * 获取数据表的结构描述
     *
     * @param string $tableName 表名
     */
    public function getTableFields(string $tableName): array
    {
        $stmt = $this->conn->query('SHOW FULL COLUMNS FROM ' . $tableName);
        $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        unset($stmt);

        return $fields;
    }

    /**
     * 获取数据表的索引
     *
     * @param string $tableName 表名
     */
    public function getTableIndex(string $tableName): array
    {
        $stmt = $this->conn->query('SHOW INDEX FROM ' . $tableName);
        $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        unset($stmt);

        return $fields;
    }

    /**
     * 检测连接
     *
     * @throws \SyException\Mysql\MysqlException
     */
    public function reConnect()
    {
        $nowTime = time();
        if (null === $this->conn) {
            $this->initConn();

            return;
        }
        if (($nowTime - $this->connTime) < 30) {
            return;
        }

        $checkRes = false;

        try {
            $this->conn->query('SELECT 1');
            $checkRes = true;
        } catch (\Exception $e) {
            $errMsg = $e->getMessage();
            $reconnectTag = false;
            foreach ($this->reconnectMessages as $eMessage) {
                if (false !== stripos($errMsg, $eMessage)) {
                    $reconnectTag = true;

                    break;
                }
            }

            if ($reconnectTag) {
                $this->initConn();
            } else {
                Log::error($errMsg, $e->getCode(), $e->getTraceAsString());

                throw new MysqlException('MySQL连接出错', ErrorCode::MYSQL_CONNECTION_ERROR);
            }
        } finally {
            if ($checkRes) {
                $this->connTime = $nowTime;
            }
        }
    }

    protected function initConn(): bool
    {
        $this->conn = null;
        $configs = Tool::getConfig('db.' . SY_ENV . SY_PROJECT . '.mysql.' . $this->dbTag);
        $host = Tool::getArrayVal($configs, 'host');
        $port = Tool::getArrayVal($configs, 'port');
        $db = Tool::getArrayVal($configs, 'db');
        $pwd = Tool::getArrayVal($configs, 'password');
        $user = Tool::getArrayVal($configs, 'user');
        $charset = Tool::getArrayVal($configs, 'charset', 'utf8mb4');
        $dsn = 'mysql:host=' . $host . ';port=' . $port . ';dbname=' . $db;

        try {
            $this->conn = new \PDO($dsn, $user, $pwd, [
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                \PDO::ATTR_PERSISTENT => true,
                \PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $charset,
                \PDO::ATTR_TIMEOUT => 2,
            ]);

            $this->dbName = $db;
            $this->connTime = Tool::getNowTime();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

            throw new MysqlException('MySQL连接出错', ErrorCode::MYSQL_CONNECTION_ERROR);
        }

        return true;
    }

    /**
     * 切换数据库
     *
     * @param string $dbName 数据库名
     */
    private function changeDb(string $dbName)
    {
        if ((\strlen($dbName) > 0) && ($this->dbName != $dbName)) {
            $this->conn->exec('USE ' . $dbName);
            $this->dbName = $dbName;
        }
    }
}
