<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:07
 */
namespace DB\Models;

abstract class BaseModel {
    protected $_dbConn = null;
    protected $_dbName = '';
    protected $_tableName = '';
    protected $_primaryKey = '';

    public function __construct(){
    }

    /**
     * @return string
     */
    public function getPrimaryKey() : string {
        return $this->_primaryKey;
    }

    /**
     * @return string
     */
    public function getDbName() : string {
        return $this->_dbName;
    }

    /**
     * @return string
     */
    public function getTableName() : string {
        return $this->_tableName;
    }

    abstract public function getDbConn();
    abstract public function setDbName(string $dbName);
    abstract public function getDbTable() : string;
}