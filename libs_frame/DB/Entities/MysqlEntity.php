<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:26
 */
namespace DB\Entities;

use DB\Containers\MysqlContainer;

class MysqlEntity extends BaseEntity {
    public function __construct(string $dbName,string $tableName,string $primaryKey='id') {
        parent::__construct();
        $this->_container = new MysqlContainer($dbName, $tableName, $primaryKey);
        $this->_dbType = BaseEntity::DB_TYPE_MYSQL;
        $this->_container->getModel()->setEntityProperties($this->getEntityProperties());
    }

    /**
     * @return \DB\Containers\MysqlContainer
     */
    public function getContainer() {
        return $this->_container;
    }
}