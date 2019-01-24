<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:20
 */
namespace DB\Containers;

use DB\Models\MysqlModel;

class MysqlContainer extends BaseContainer {
    public function __construct(string $dbName,string $tableName,string $primaryKey='id') {
        parent::__construct();
        $this->_model = new MysqlModel($dbName, $tableName, $primaryKey);
    }

    /**
     * @return \DB\Models\MysqlModel
     */
    public function getModel() {
        return $this->_model;
    }

    /**
     * 修改数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array $data
     * @param object|array $obj 观察者对象
     * @return mixed
     */
    public function update($result,array $data, $obj){
        $affectNum = $this->_model->update($result, $data);
        if($affectNum !== false){
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 插入数据
     * @param array $data
     * @param object|array $obj 观察者对象
     * @return int|string
     */
    public function insert(array $data, $obj){
        $affectNum = $this->_model->insert($data);
        if($affectNum !== false){
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 插入或修改数据，不存在就插入，存在就修改
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array $unique
     * @param array $insert
     * @param array $update
     * @param object|array $obj 观察者对象
     * @return mixed
     */
    public function insertOrUpdate($result,array $unique,array $insert,array $update, $obj) {
        $affectNum = $this->_model->insertOrUpdate($result, $unique, $insert, $update);
        if ($affectNum !== false) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 删除数据
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param object|array $obj 观察者对象
     * @return mixed
     */
    public function delete($result, $obj) {
        $affectNum = $this->_model->delete($result);
        if ($affectNum !== false) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }
}