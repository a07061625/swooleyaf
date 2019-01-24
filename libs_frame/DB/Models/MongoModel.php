<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/27 0027
 * Time: 14:32
 */
namespace DB\Models;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Singletons\MongoSingleton;
use Exception\Mongo\MongoException;
use Log\Log;
use MongoDB\BSON\ObjectID;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Command;
use MongoDB\Driver\Query;
use MongoDB\Driver\WriteConcern;
use Tool\Tool;

class MongoModel extends BaseModel{
    /**
     * 实体属性数组
     * @var array
     */
    private $_entityProps = [];
    private $_where = [];
    private $_sort = [];
    private $_fields = [];
    private $_group = [];

    public function __construct(string $dbName,string $tableName) {
        $this->_dbConn = MongoSingleton::getInstance()->getConn();
        $this->_dbName = $dbName;
        $this->_tableName = $tableName;
        $this->_primaryKey = '_id';

        $this->_where = [];
        $this->_sort = [];
        $this->_fields = [];
        $this->_group = [];
    }

    /**
     * 初始化查询字段
     * @param bool $isShow 是否显示字段,true:显示 false:不显示
     */
    private function initFields(bool $isShow) {
        $this->_fields = [];

        if($isShow){
            foreach ($this->_entityProps as $eProp => $eType) {
                $this->_fields[$eProp] = 1;
            }
        } else {
            foreach ($this->_entityProps as $eProp => $eType) {
                $this->_fields[$eProp] = 0;
            }
        }
    }

    /**
     * 设置实体属性
     * @param array $props
     */
    public function setEntityProperties(array $props) {
        $this->_entityProps = $props;
        $this->initFields(true);
    }

    /**
     * @return \MongoDB\Driver\Manager
     */
    public function getDbConn() {
        return $this->_dbConn;
    }

    public function setDbName(string $dbName) {
        MongoSingleton::getInstance()->changeDb($dbName);
        $this->_dbName = $dbName;
    }

    public function getDbTable() : string {
        return $this->_dbName . '.' . $this->_tableName;
    }

    private function clearModel() {
        $this->_where = [];
        $this->_sort = [];
        $this->_group = [];
        $this->initFields(true);
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

        if($filter){
            $this->initFields(true);
            foreach ($fieldArr as $eField) {
                if(isset($this->_fields[$eField])){
                    $this->_fields[$eField] = 0;
                }
            }
        } else {
            $this->initFields(false);
            foreach ($fieldArr as $eField) {
                if(isset($this->_fields[$eField])){
                    $this->_fields[$eField] = 1;
                }
            }
        }

        return $this;
    }

    /**
     * 设置条件
     * @param array $where 条件数组
     * @return $this
     */
    public function where(array $where) {
        foreach ($where as $key => $val) {
            $field = trim($key);
            if(strlen($field) > 0){
                if(is_string($val) || is_numeric($val)){
                    $this->_where[$field] = $val;
                } else if(is_array($val)){
                    $nowWhere = isset($this->_where[$field]) ? $this->_where[$field] : null;
                    $this->_where[$field] = is_array($nowWhere) ? array_merge($nowWhere, $val) : $val;
                }
            }
        }

        return $this;
    }

    /**
     * 设置排序
     * @param string $field 排序字段
     * @param bool $isAsc 是否为升序,true:升序 false:降序
     * @return $this
     */
    public function sort(string $field,bool $isAsc=true){
        $this->_sort[$field] = $isAsc ? 1 : -1;

        return $this;
    }

    /**
     * 设置分组,用于聚合查询
     * @param array $group
     * @return $this
     */
    public function group(array $group) {
        foreach ($group as $key => $val) {
            if($key != '_id'){
                $this->_group[trim($key)] = $val;
            } else if(is_string($val) && in_array($val, $this->_entityProps)){
                $this->_group['_id'] = '$' . $val;
            }
        }

        return $this;
    }

    /**
     * 添加数据
     * @param array $data
     * @throws \Exception\Mongo\MongoException
     * @return bool|string
     */
    public function insert(array $data) {
        $id = new ObjectID();
        $data['_id'] = sha1($id . Tool::createNonceStr(8));

        $bulk = new BulkWrite();
        $writeConcern = new WriteConcern(WriteConcern::MAJORITY, 1000);
        $execRes = null;
        $affectNum = 0;

        try{
            $bulk->insert($data);
            $execRes = $this->_dbConn->executeBulkWrite($this->getDbTable(), $bulk, $writeConcern);
            $affectNum = $execRes->getInsertedCount();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_INSERT_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_INSERT_ERROR);
        } finally {
            unset($bulk, $writeConcern, $execRes);
        }

        return $affectNum ? $data['_id'] : false;
    }

    /**
     * 更新数据
     * @param array $data 数据数组
     * @param bool $multi 是否更新多个,true:更新所有符合条件的数据 false:更新第一个符合条件的数据
     * @param bool $upsert 符合条件的数据不存在时是否新增,true:新增 false:不新增
     * @throws \Exception\Mongo\MongoException
     * @return bool|int
     */
    public function update(array $data,bool $multi=false,bool $upsert=false) {
        $bulk = new BulkWrite();
        $writeConcern = new WriteConcern(WriteConcern::MAJORITY, 1000);
        $execRes = null;
        $affectNum = 0;

        try{
            $bulk->update($this->_where, [
                '$set' => $data,
            ], [
                'multi' => $multi,
                'upsert' => $upsert,
            ]);

            $execRes = $this->_dbConn->executeBulkWrite($this->getDbTable(), $bulk, $writeConcern);
            if($execRes->getModifiedCount()){
                $affectNum += $execRes->getModifiedCount();
            }
            if($execRes->getUpsertedCount()){
                $affectNum += $execRes->getUpsertedCount();
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_UPDATE_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_UPDATE_ERROR);
        } finally {
            $this->clearModel();
            unset($bulk, $writeConcern, $execRes);
        }

        return $affectNum ? $affectNum : false;
    }

    /**
     * 字段递增
     * 数据格式如下:
     * <pre>
     * [
     *     'aaa' => 123, //key为字段名,value为步进值
     * ]
     * </pre>
     *
     * @param array $data 数据数组
     * @throws \Exception\Mongo\MongoException
     * @return bool|int
     */
    public function inc(array $data) {
        $bulk = new BulkWrite();
        $writeConcern = new WriteConcern(WriteConcern::MAJORITY, 1000);
        $execRes = null;
        $affectNum = 0;

        try{
            $bulk->update($this->_where, [
                '$inc' => $data,
            ], [
                'multi' => false,
                'upsert' => false,
            ]);

            $execRes = $this->_dbConn->executeBulkWrite($this->getDbTable(), $bulk, $writeConcern);
            $affectNum = $execRes->getModifiedCount();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_UPDATE_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_UPDATE_ERROR);
        } finally {
            $this->clearModel();
            unset($bulk, $writeConcern, $execRes);
        }

        return $affectNum ? $affectNum : false;
    }

    /**
     * 删除数据
     * @param bool $multi 是否删除多个,true:删除所有符合条件的数据 false:删除第一个符合条件的数据
     * @throws \Exception\Mongo\MongoException
     * @return bool|int
     */
    public function delete(bool $multi=true) {
        $bulk = new BulkWrite();
        $writeConcern = new WriteConcern(WriteConcern::MAJORITY, 1000);
        $execRes = null;
        $affectNum = 0;

        try{
            $bulk->delete($this->_where, [
                'limit' => $multi ? 0 : 1,
            ]);

            $execRes = $this->_dbConn->executeBulkWrite($this->getDbTable(), $bulk, $writeConcern);
            $affectNum = $execRes->getDeletedCount();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_DELETE_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_DELETE_ERROR);
        } finally {
            $this->clearModel();
            unset($bulk, $writeConcern, $execRes);
        }

        return $affectNum ? $affectNum : false;
    }

    /**
     * 查询数据
     * @param int $page 页数
     * @param int $limit 每页限制
     * @throws \Exception\Mongo\MongoException
     * @return array
     */
    public function select(int $page,int $limit) : array {
        $data = [];
        $query = null;
        $cursor = null;
        $limitNum = $limit > 0 ? $limit : Project::COMMON_LIMIT_DEFAULT;
        $options = [
            'limit' => $limitNum,
            'skip' => $page > 0 ? ($page - 1) * $limitNum : 0,
        ];
        if(!empty($this->_fields)){
            $options['projection'] = $this->_fields;
        }
        if (!empty($this->_sort)) {
            $options['sort'] = $this->_sort;
        }

        try{
            $query = new Query($this->_where, $options);
            $cursor = $this->_dbConn->executeQuery($this->getDbTable(), $query)->toArray();
            foreach ($cursor as $row) {
                $data[] = (array)$row;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR);
        } finally {
            $this->clearModel();
            unset($query, $cursor, $options);
        }

        return $data;
    }

    /**
     * 获取满足条件的数据总数
     * @return int
     * @throws \Exception\Mongo\MongoException
     */
    private function getCount() : int {
        $countNum = 0;
        $command = null;
        $cursor = null;

        try {
            $command = new Command([
                'count' => $this->_tableName,
                'query' => $this->_where,
            ]);
            $cursor = $this->_dbConn->executeCommand($this->_dbName, $command)->toArray();
            $countNum = (int)$cursor[0]->n;
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR);
        } finally {
            unset($command, $cursor);
        }

        return $countNum;
    }

    /**
     * 分页获取数据
     * @param int $page 页数
     * @param int $limit 每页限制
     * @return array
     */
    public function findPage(int $page,int $limit) : array {
        $nowPage = $page > 0 ? $page : Project::COMMON_PAGE_DEFAULT;
        $pageSize = $limit > 0 ? $limit : Project::COMMON_LIMIT_DEFAULT;
        $totalNum = $this->getCount();

        return [
            'current' => $nowPage,
            'limit' => $pageSize,
            'pages' => (int)ceil($totalNum / $pageSize),
            'total' => $totalNum,
            'data' => $this->select($nowPage, $pageSize),
        ];
    }

    /**
     * 获取单条数据
     * @return array
     */
    public function findOne() : array {
        $data = $this->select(1, 1);

        return empty($data) ? [] : $data[0];
    }

    /**
     * 聚合查询
     * @param int $page 分页数
     * @param int $limit 分页限制
     * @return array
     * @throws \Exception\Mongo\MongoException
     */
    public function aggregate(int $page,int $limit) : array {
        $nowPage = $page > 0 ? $page : Project::COMMON_PAGE_DEFAULT;
        $pageSize = $limit > 0 ? $limit : Project::COMMON_LIMIT_DEFAULT;
        $data = [];
        $operations = [];
        $command = null;
        $cursor = null;
        //以下管道命令执行顺序不能换,否则会导致数据查询不正确
        if(!empty($this->_where)){
            $operations[] = [
                '$match' => $this->_where,
            ];
        }
        $operations[] = [
            '$group' => $this->_group,
        ];
        if(!empty($this->_sort)){
            $operations[] = [
                '$sort' => $this->_sort,
            ];
        }
        $operations[] = [
            '$skip' => $nowPage > 1 ? ($nowPage - 1) * $pageSize : 0,
        ];
        $operations[] = [
            '$limit' => $pageSize,
        ];

        try {
            if(empty($this->_group)){
                throw new MongoException('分组设置不能为空', ErrorCode::MONGO_SELECT_ERROR);
            } else if(!isset($this->_group['_id'])){
                throw new MongoException('分组字段不能为空', ErrorCode::MONGO_SELECT_ERROR);
            }

            $command = new Command([
                'aggregate' => $this->_tableName,
                'pipeline' => $operations,
            ]);
            $cursor = $this->_dbConn->executeCommand($this->_dbName, $command)->toArray();
            $result = $cursor[0]->result;
            foreach ($result as $eData) {
                $data[] = (array)$eData;
            }
            unset($eData, $result);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR, $e->getTraceAsString());

            throw new MongoException($e->getMessage(), ErrorCode::MONGO_SELECT_ERROR);
        } finally {
            $this->clearModel();
            unset($command, $cursor, $operations);
        }

        return $data;
    }
}