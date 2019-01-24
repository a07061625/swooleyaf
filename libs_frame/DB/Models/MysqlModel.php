<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/3/5 0005
 * Time: 12:26
 */
namespace DB\Models;

use Constant\ErrorCode;
use Constant\Project;
use DB\Models\NotORM\NotORM;
use DB\Models\NotORM\NotORM_Result;
use DB\Models\NotORM\NotORM_Structure_Convention;
use DesignPatterns\Singletons\MysqlSingleton;
use Exception\Mysql\MysqlException;
use Log\Log;

class MysqlModel extends BaseModel {
    /**
     * @var \DB\Models\NotORM\NotORM
     */
    private $_db = null;
    /**
     * @var \DB\Models\NotORM\NotORM_Structure_Convention
     */
    private $_structure = null;
    /**
     * 实体属性数组
     * @var array
     */
    private $_entityProps = [];
    private $_fields = [];

    public function __construct(string $dbName,string $tableName,string $primaryKey='id') {
        $this->_dbConn = MysqlSingleton::getInstance()->getConn();
        $this->_dbName = $dbName;
        $this->_tableName = $tableName;
        $this->_primaryKey = $primaryKey;

        $this->_structure = new NotORM_Structure_Convention($primaryKey, '', $dbName . '.%s');
        $this->_db = new NotORM($this->_dbConn, $this->_structure);
    }

    /**
     * 设置实体属性
     * @param array $props
     */
    public function setEntityProperties(array $props) {
        $this->_entityProps = $props;
    }

    /**
     * @return \PDO
     */
    public function getDbConn() {
        return $this->_dbConn;
    }

    public function setDbName(string $dbName) {
        MysqlSingleton::getInstance()->changeDb($dbName);
        $this->_dbName = $dbName;
    }

    public function getDbTable() : string {
        return '`' . $this->_dbName . '`.`' . $this->_tableName . '`';
    }

    /**
     * @return \DB\Models\NotORM\NotORM
     */
    public function getOrmDb() {
        return $this->_db;
    }

    /**
     * @return \DB\Models\NotORM\NotORM_Result
     */
    public function getOrmDbTable() {
        $tableName = $this->_tableName;
        return $this->_db->$tableName();
    }

    private function clearModel() {
        $this->_fields = [];
    }

    /**
     * 设置查询结果字段
     * @param array|string $fields 查询结果字段
     * @param bool $filter 是否过滤,true:过滤 false:不过滤
     * @return $this
     */
    public function setFields($fields,bool $filter=false) {
        $fieldArr = [];
        if(is_array($fields)){
            foreach ($fields as $eField) {
                if(is_numeric($eField)){
                    $fieldArr[] = trim($eField);
                } else if(is_string($eField)){
                    $trueField = preg_replace('/\s+/', ' ', trim($eField));
                    if(strlen($trueField) > 0){
                        $fieldArr[] = $trueField;
                    }
                }
            }
        } else if(is_string($fields)){
            $trueFields = preg_replace([
                '/\s+\,\s+/',
                '/\s+/',
            ], [
                ',',
                ' ',
            ], trim($fields));
            $trueArr = explode(',', $trueFields);
            foreach ($trueArr as $eData) {
                if(strlen($eData) > 0){
                    $fieldArr[] = $eData;
                }
            }
        }
        array_unique($fieldArr);

        $this->_fields = [];
        if($filter){
            foreach ($this->_entityProps as $eProp => $eType) {
                if(!in_array($eProp, $fieldArr)){
                    $this->_fields[] = $eProp;
                }
            }
        } else {
            $this->_fields = $fieldArr;
        }

        return $this;
    }

    /**
     * 迭代器处理，转换数据结构，从对象类型转换成二维数组
     * @param \DB\Models\NotORM\NotORM_Result $obj
     * @return array
     */
    private function iteratorArray(NotORM_Result $obj) : array {
        $data = [];
        foreach ($obj as $row) {
            $data[] = iterator_to_array($row);
        }

        return $data;
    }

    /**
     * 设置orm查询字段
     * @param \DB\Models\NotORM\NotORM_Result $result
     */
    private function setResultFields(NotORM_Result &$result) {
        $result->select('');

        if(empty($this->_fields)){
            $fieldStr = '`' . implode('`,`', array_keys($this->_entityProps)) . '`';
            $result->select($fieldStr);
        } else {
            $fieldStr = '';
            foreach ($this->_fields as $eField) {
                if(isset($this->_entityProps[$eField])){
                    $fieldStr .= ',`' . $eField . '`';
                } else {
                    $fieldStr .= ',' . $eField;
                }
            }

            $result->select(substr($fieldStr, 1));
        }
    }

    /**
     * 查询数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param int $page 页数
     * @param int $limit 分页限制
     * @return array
     * @throws \Exception\Mysql\MysqlException
     */
    public function select(NotORM_Result $result,int $page=1,int $limit=1000) : array {
        $this->setResultFields($result);
        $truePage = $page > 0 ? $page : Project::COMMON_PAGE_DEFAULT;
        $trueLimit = $limit > 0 ? $limit : 1000;
        $startIndex = ($truePage - 1) * $limit;

        try {
            return $this->iteratorArray($result->limit($trueLimit, $startIndex));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR);
        } finally {
            $this->clearModel();
        }

    }

    /**
     * 分页查询
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param int $page 页数
     * @param int $limit 分页限制
     * @throws \Exception\Mysql\MysqlException
     * @return array
     */
    public function findPage(NotORM_Result $result,int $page,int $limit) : array {
        $resArr = [
            'total' => 0,
            'limit' => $limit > 0 ? $limit : Project::COMMON_LIMIT_DEFAULT,
            'pages' => 0,
            'current' => $page > 0 ? $page : Project::COMMON_PAGE_DEFAULT,
            'data' => []
        ];

        $this->setResultFields($result);
        $self = $result;
        $startIndex = ($resArr['current'] - 1) * $resArr['limit'];

        try {
            $resArr['total'] = $self->count('*');
            $resArr['pages'] = (int)ceil($resArr['total'] / $resArr['limit']);
            $resArr['data'] = $this->iteratorArray($result->limit($resArr['limit'], $startIndex));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR);
        } finally {
            $this->clearModel();
        }

        return $resArr;
    }

    /**
     * 查询单条数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @throws \Exception\Mysql\MysqlException
     * @return array
     */
    public function findOne(NotORM_Result $result) : array {
        $this->setResultFields($result);

        try {
            $record = $this->iteratorArray($result->limit(1));
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_SELECT_ERROR);
        } finally {
            $this->clearModel();
        }

        return empty($record) ? [] : $record[0];
    }

    /**
     * 开启事务
     * @return bool true:开启成功 false:开启失败
     */
    public function openTransaction() : bool {
        if ($this->_dbConn->inTransaction()) {
            return true;
        } else {
            return $this->_dbConn->beginTransaction();
        }
    }

    /**
     * 提交事务
     * @return bool
     */
    public function commitTransaction() : bool {
        if ($this->_dbConn->inTransaction()) {
            return $this->_dbConn->commit();
        }

        return true;
    }

    /**
     * 回滚事务
     * @return bool
     */
    public function rollbackTransaction() : bool {
        if ($this->_dbConn->inTransaction()) {
            return $this->_dbConn->rollBack();
        }

        return false;
    }

    /**
     * 修改数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array $data
     * @throws \Exception\Mysql\MysqlException
     * @return mixed
     */
    public function update(NotORM_Result $result,array $data){
        try {
            $affectNum = $result->update($data);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_UPDATE_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_UPDATE_ERROR);
        }

        return $affectNum;
    }

    /**
     * 插入数据
     * @param array $data
     * @throws \Exception\Mysql\MysqlException
     * @return int|string
     */
    public function insert(array $data){
        $table = $this->getOrmDbTable();

        try {
            $affectNum = $table->insert_multi([
                $data,
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_INSERT_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_INSERT_ERROR);
        }

        return $affectNum ? $table->insert_id() : $affectNum;
    }

    /**
     * 插入或修改数据，不存在就插入，存在就修改
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array $unique
     * @param array $insert
     * @param array $update
     * @throws \Exception\Mysql\MysqlException
     * @return mixed
     */
    public function insertOrUpdate(NotORM_Result $result,array $unique,array $insert,array $update = array()) {
        try {
            $affectNum = $result->insert_update($unique, $insert, $update);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_UPSERT_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_UPSERT_ERROR);
        }

        return $affectNum;
    }

    /**
     * 删除数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @throws \Exception\Mysql\MysqlException
     * @return mixed
     */
    public function delete(NotORM_Result $result) {
        try {
            $affectNum = $result->delete();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MYSQL_DELETE_ERROR, $e->getTraceAsString());

            throw new MysqlException($e->getMessage(), ErrorCode::MYSQL_DELETE_ERROR);
        }

        return $affectNum;
    }
}