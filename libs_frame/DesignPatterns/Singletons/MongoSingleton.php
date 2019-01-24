<?php
/**
 * MongoDB数据库连接类
 * User: 姜伟
 * Date: 2017/5/27 0027
 * Time: 12:13
 */
namespace DesignPatterns\Singletons;

use Constant\ErrorCode;
use Exception\Mongo\MongoException;
use Log\Log;
use MongoDB\Driver\Command;
use MongoDB\Driver\Manager;
use Tool\Tool;
use Traits\SingletonTrait;

class MongoSingleton {
    use SingletonTrait;

    /**
     * 数据库名称
     * @var string
     */
    private $dbName = '';
    /**
     * @var \MongoDB\Driver\Manager
     */
    private $conn = null;

    private function __construct() {
        $configs = Tool::getConfig('mongo.' . SY_ENV . SY_PROJECT);
        $hostStr = '';
        foreach ($configs['hosts'] as $key => $host) {
            $port = isset($configs['ports'][$key]) ? $configs['ports'][$key] : 27017;
            $hostStr .= ',' . $host . ':' . $port;
        }
        if(strlen($hostStr) == 0){
            throw new MongoException('连接域名不正确', ErrorCode::MONGO_CONNECTION_ERROR);
        }

        $db = (string)Tool::getArrayVal($configs, 'db', 'admin');
        $url = 'mongodb://' . substr($hostStr, 1) . '/' . $db;

        $uriOptions = Tool::getArrayVal($configs, 'uri', []);
        $uriOptions['connectTimeoutMS'] = 2000;
        $uriOptions['w'] = 1;
        $uriOptions['wTimeoutMS'] = 3000;
        $driverOptions = Tool::getArrayVal($configs, 'driver', []);

        try{
            $this->conn = new Manager($url, $uriOptions, $driverOptions);
            $this->dbName = $db;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_CONNECTION_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_CONNECTION_ERROR);
        }
    }

    /**
     * @return \DesignPatterns\Singletons\MongoSingleton
     */
    public static function getInstance() {
        if(is_null(self::$instance)){
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return Manager
     */
    public function getConn() {
        return $this->conn;
    }

    /**
     * 切换数据库
     * @param string $dbName 数据库名称
     * @throws \Exception\Mongo\MongoException
     */
    public function changeDb(string $dbName) {
        if ((strlen($dbName) > 0) && ($dbName != $this->dbName)) {
            $command = new Command([
                'ping' => 1,
            ]);

            try {
                $this->conn->executeCommand($dbName, $command);
                $servers = $this->conn->getServers();
                if (!$servers) {
                    throw new MongoException('切换数据库失败', ErrorCode::MONGO_CONNECTION_ERROR);
                }

                $this->dbName = $dbName;
            } catch (MongoException $e) {
                throw $e;
            } catch (\Exception $e) {
                Log::error($e->getMessage(), $e->getCode(), $e->getTraceAsString());

                throw new MongoException('切换数据库出错', ErrorCode::MONGO_CONNECTION_ERROR);
            }
        }
    }
}