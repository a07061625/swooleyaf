<?php
/**
 * MYSQL数据库连接类
 * User: 姜伟
 * Date: 2017/1/3 0003
 * Time: 12:18
 */
namespace DesignPatterns\Singletons;

use Constant\ErrorCode;
use Exception\Mysql\MysqlException;
use Log\Log;
use Tool\Tool;
use Traits\SingletonTrait;

class MysqlSingleton {
    use SingletonTrait;

    /**
     * 数据库名称
     * @var string
     */
    private $dbName = '';
    /**
     * @var \PDO
     */
    private $conn = null;
    /**
     * 重连错误码
     * @var array
     */
    private $reconnectCodes = [];
    /**
     * @var int
     */
    private $connTime = 0;

    private function __construct() {
        $this->init();
        $this->reconnectCodes = [
            2006,
            2013,
        ];
    }

    /**
     * @throws \Exception\Mysql\MysqlException
     */
    private function init() {
        $this->conn = null;
        $configs = Tool::getConfig('mysql.' . SY_ENV . SY_PROJECT);

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
    }

    /**
     * @return \DesignPatterns\Singletons\MysqlSingleton
     */
    public static function getInstance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return \PDO
     */
    public function getConn() {
        return $this->conn;
    }

    /**
     * @return string
     */
    public function getDbName() : string {
        return $this->dbName;
    }

    /**
     * @param string $dbName
     */
    public function setDbName(string $dbName) {
        $this->dbName = $dbName;
    }

    /**
     * 切换数据库
     * @param string $dbName 数据库名
     */
    public function changeDb(string $dbName) {
        if ((strlen($dbName) > 0) && ($this->dbName != $dbName)) {
            $this->conn->exec('USE ' . $dbName);
            $this->dbName = $dbName;
        }
    }

    /**
     * 获取所有数据库
     * @param bool $filter 是否过滤mysql配置数据库，true：过滤 false：不过滤
     * @return array
     */
    public function getDbs(bool $filter) : array {
        $stmt = $this->conn->query('SHOW DATABASES');
        $dbs = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        unset($stmt);
        if ($filter) {
            return array_diff($dbs, ['information_schema', 'performance_schema', 'mysql']);
        } else {
            return $dbs;
        }
    }

    /**
     * 获取数据库的所有表名
     * @param string $dbName 数据库名
     * @return array
     */
    public function getDbTables(string $dbName='') : array {
        $this->changeDb($dbName);

        $stmt = $this->conn->query('SHOW TABLES');
        $tables = $stmt->fetchAll(\PDO::FETCH_COLUMN);
        unset($stmt);

        return $tables;
    }

    /**
     * 获取数据表的结构描述
     * @param string $tableName 表名
     * @param string $dbName 数据库名
     * @return array
     */
    public function getTableFields(string $tableName, string $dbName='') : array {
        $this->changeDb($dbName);

        $stmt = $this->conn->query('SHOW FULL COLUMNS FROM ' . $tableName);
        $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        unset($stmt);

        return $fields;
    }

    /**
     * 获取数据表的索引
     * @param string $tableName 表名
     * @param string $dbName 数据库名
     * @return array
     */
    public function getTableIndex(string $tableName, string $dbName='') : array {
        $this->changeDb($dbName);

        $stmt = $this->conn->query('SHOW INDEX FROM ' . $tableName);
        $fields = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        unset($stmt);

        return $fields;
    }

    /**
     * 检测连接
     * @throws \Exception\Mysql\MysqlException
     */
    public function reConnect() {
        $nowTime = time();
        if(is_null($this->conn)){
            $this->init();
        } else if($nowTime - $this->connTime >= 30){
            try {
                $this->conn->getAttribute(\PDO::ATTR_SERVER_INFO);
            } catch (\PDOException $e) {
                if (in_array((int)$e->errorInfo[1], $this->reconnectCodes)) {
                    $this->init();
                } else {
                    Log::error($e->errorInfo[2], $e->errorInfo[1], $e->getTraceAsString());

                    throw new MysqlException('MySQL连接出错', ErrorCode::MYSQL_CONNECTION_ERROR);
                }
            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                throw new MysqlException('MySQL连接出错', ErrorCode::MYSQL_CONNECTION_ERROR);
            } finally {
                $this->connTime = $nowTime;
            }
        }
    }
}