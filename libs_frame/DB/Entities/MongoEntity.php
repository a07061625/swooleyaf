<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/27 0027
 * Time: 14:48
 */
namespace DB\Entities;

use DB\Containers\MongoContainer;

class MongoEntity extends BaseEntity {
    public function __construct(string $dbName,string $tableName) {
        parent::__construct();
        $this->_container = new MongoContainer($dbName, $tableName);
        $this->_dbType = BaseEntity::DB_TYPE_MONGO;
        $this->_container->getModel()->setEntityProperties($this->getEntityProperties());
    }

    /**
     * @return \DB\Containers\MongoContainer
     */
    public function getContainer() {
        return $this->_container;
    }
}