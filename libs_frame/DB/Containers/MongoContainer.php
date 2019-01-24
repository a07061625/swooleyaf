<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2017/5/27 0027
 * Time: 14:31
 */
namespace DB\Containers;

use DB\Models\MongoModel;

class MongoContainer extends BaseContainer {
    public function __construct(string $dbName,string $tableName) {
        parent::__construct();
        $this->_model = new MongoModel($dbName, $tableName);
    }

    public function getModel() {
        return $this->_model;
    }

    /**
     * 插入数据
     * @param array $data
     * @param object $obj 观察者对象
     * @return bool|string
     */
    public function insert(array $data, $obj) {
        $id = $this->_model->insert($data);
        if ($id) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $id;
    }

    /**
     * 更新数据
     * @param array $data 数据数组
     * @param object $obj 观察者对象
     * @param bool $multi 是否更新多个,true:更新所有符合条件的数据 false:更新第一个符合条件的数据
     * @param bool $upsert 符合条件的数据不存在时是否新增,true:新增 false:不新增
     * @return bool|int
     */
    public function update(array $data, $obj,bool $multi=false,bool $upsert=false) {
        $affectNum = $this->_model->update($data, $multi, $upsert);
        if ($affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 删除数据
     * @param object $obj 观察者对象
     * @param bool $multi 是否删除多个,true:删除所有符合条件的数据 false:删除第一个符合条件的数据
     * @return bool|int
     */
    public function delete($obj,bool $multi=true) {
        $affectNum = $this->_model->delete($multi);
        if ($affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }
}