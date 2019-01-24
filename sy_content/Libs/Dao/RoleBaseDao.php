<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:21
 */
namespace Dao;

use Constant\ErrorCode;
use Constant\Project;
use Exception\Common\CheckException;
use Factories\SyBaseMysqlFactory;
use ProjectCache\Role;
use Tool\Tool;
use Traits\SimpleDaoTrait;

class RoleBaseDao {
    use SimpleDaoTrait;

    public static function addRoleByStation(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if(!empty($roleBaseInfo)){
            throw new CheckException('标识已存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $nowTime = Tool::getNowTime();
        $roleBase->tag = $data['tag'];
        $roleBase->title = $data['title'];
        $roleBase->status = Project::ROLE_STATUS_VALID;
        $roleBase->created = $nowTime;
        $roleBase->updated = $nowTime;
        $roleId = $roleBase->getContainer()->getModel()->insert($roleBase->getEntityDataArray());
        if(!$roleId){
            throw new CheckException('添加角色失败', ErrorCode::COMMON_SERVER_ERROR);
        }
        unset($ormResult1, $roleBase);

        return [
            'role_tag' => $data['tag'],
        ];
    }

    public static function editRoleByStation(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if(empty($roleBaseInfo)){
            throw new CheckException('角色信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $roleBase->getContainer()->getModel()->update($ormResult1, [
            'title' => $data['title'],
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $roleBase);

        Role::clearRolePowerList($data['tag']);

        return [
            'msg' => '修改角色信息成功',
        ];
    }

    public static function getRoleInfoByStation(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['role_tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if(empty($roleBaseInfo)){
            throw new CheckException('角色信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        $roleBaseInfo['total_status'] = Project::$totalRoleStatus;
        unset($ormResult1, $roleBase);

        return $roleBaseInfo;
    }

    public static function getRoleListByStation(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        if($data['role_status'] > -2){
            $ormResult1->where('`status`=?', [$data['role_status']]);
        } else {
            $ormResult1->where('status', array_keys(Project::$totalRoleStatus));
        }
        $ormResult1->order('`created` DESC,`tag` ASC');
        $roleList = $roleBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $roleList['total_status'] = Project::$totalRoleStatus;
        unset($ormResult1, $roleBase);

        return $roleList;
    }

    public static function getRoleListByFront(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`status`=?', [Project::ROLE_STATUS_VALID])
                   ->order('`tag` ASC');
        $roleList = $roleBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $roleList['total_status'] = Project::$totalRoleStatus;
        unset($ormResult1, $roleBase);

        return $roleList;
    }
}