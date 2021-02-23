<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:26
 */

namespace DB\Entities;

use DB\Containers\MysqlContainer;

class MysqlEntity extends BaseEntity
{
    public function __construct(string $dbTag, string $tableName, string $primaryKey = 'id')
    {
        parent::__construct();
        $this->_container = new MysqlContainer($dbTag, $tableName, $primaryKey);
        $this->_dbType = BaseEntity::DB_TYPE_MYSQL;
        $this->_container->getModel()->setEntityProperties($this->getEntityProperties());
    }

    public function getContainer(): MysqlContainer
    {
        return $this->_container;
    }
}
