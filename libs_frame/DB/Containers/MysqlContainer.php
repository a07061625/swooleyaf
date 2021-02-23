<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017-3-5
 * Time: 15:20
 */

namespace DB\Containers;

use DB\Models\MysqlModel;

class MysqlContainer extends BaseContainer
{
    public function __construct(string $dbTag, string $tableName, string $primaryKey = 'id')
    {
        parent::__construct();
        $this->_model = new MysqlModel($dbTag, $tableName, $primaryKey);
    }

    public function getModel(): MysqlModel
    {
        return $this->_model;
    }

    /**
     * 修改数据
     *
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array|object                    $obj    观察者对象
     *
     * @return mixed
     */
    public function update($result, array $data, $obj)
    {
        $affectNum = $this->_model->update($result, $data);
        if (false !== $affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 插入数据
     *
     * @param array|object $obj 观察者对象
     *
     * @return int|string
     */
    public function insert(array $data, $obj)
    {
        $affectNum = $this->_model->insert($data);
        if (false !== $affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 插入或修改数据，不存在就插入，存在就修改
     *
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array|object                    $obj    观察者对象
     *
     * @return mixed
     */
    public function insertOrUpdate($result, array $unique, array $insert, array $update, $obj)
    {
        $affectNum = $this->_model->insertOrUpdate($result, $unique, $insert, $update);
        if (false !== $affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }

    /**
     * 删除数据
     *
     * @param \DB\Models\NotORM\NotORM_Result $result
     * @param array|object                    $obj    观察者对象
     *
     * @return mixed
     */
    public function delete($result, $obj)
    {
        $affectNum = $this->_model->delete($result);
        if (false !== $affectNum) {
            $this->setSubjectObj($obj);
            $this->notify();
        }

        return $affectNum;
    }
}
