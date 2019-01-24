<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:22
 */
namespace Dao;

use Constant\ErrorCode;
use Constant\Project;
use Exception\Common\CheckException;
use Factories\SyBaseMysqlFactory;
use ProjectCache\Role;
use Tool\Tool;
use Traits\SimpleDaoTrait;

class RolePowerDao {
    use SimpleDaoTrait;

    public static function addPowerByStation(array $data){
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        if($data['level'] > Project::ROLE_POWER_LEVEL_ONE){
            $ormResult1->where('tag', [$data['ptag'], $data['tag'],])
                       ->order('`tag` ASC');
            $powerList = $rolePower->getContainer()->getModel()->select($ormResult1, 1, 10);
            if(empty($powerList)){
                throw new CheckException('上级权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
            } else if(count($powerList) > 1){
                throw new CheckException('已存在相同标识的权限', ErrorCode::COMMON_PARAM_ERROR);
            }
        } else {
            $ormResult1->where('`tag`=?', [$data['tag']]);
            $powerInfo = $rolePower->getContainer()->getModel()->findOne($ormResult1);
            if(!empty($powerInfo)){
                throw new CheckException('已存在相同标识的权限', ErrorCode::COMMON_PARAM_ERROR);
            }
        }

        $nowTime = Tool::getNowTime();
        $rolePower->tag = $data['tag'];
        $rolePower->level = $data['level'];
        $rolePower->title = $data['title'];
        $rolePower->icon = $data['icon'];
        $rolePower->router_path = $data['path'];
        $rolePower->sort_num = $data['sort_num'];
        $rolePower->created = $nowTime;
        $rolePower->updated = $nowTime;
        $powerId = $rolePower->getContainer()->getModel()->insert($rolePower->getEntityDataArray());
        if(!$powerId){
            throw new CheckException('添加权限信息失败,请稍候重试', ErrorCode::COMMON_SERVER_ERROR);
        }
        unset($ormResult1, $rolePower);

        Role::clearRolePowerList();

        return [
            'power_tag' => $data['tag'],
        ];
    }

    public static function getPowerInfoByStation(array $data){
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['power_tag']]);
        $powerInfo = $rolePower->getContainer()->getModel()->findOne($ormResult1);
        if(empty($powerInfo)){
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        $powerInfo['total_level'] = Project::$totalRolePowerLevel;
        unset($ormResult1, $rolePower);

        return $powerInfo;
    }

    public static function editPowerByStation(array $data){
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['power_tag']]);
        $powerInfo = $rolePower->getContainer()->getModel()->findOne($ormResult1);
        if(empty($powerInfo)){
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $rolePower->getContainer()->getModel()->update($ormResult1, [
            'title' => $data['title'],
            'icon' => $data['icon'],
            'router_path' => $data['path'],
            'sort_num' => $data['sort_num'],
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $rolePower);

        Role::clearRolePowerList();

        return [
            'msg' => '修改权限信息成功',
        ];
    }

    public static function delPowerByStation(array $data){
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['power_tag']]);
        $powerInfo = $rolePower->getContainer()->getModel()->findOne($ormResult1);
        if(empty($powerInfo)){
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ormResult2 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag` LIKE ?', [$data['power_tag'] . '%']);
        $rolePower->getContainer()->getModel()->delete($ormResult2);

        $roleRelation = SyBaseMysqlFactory::RoleRelationEntity();
        $ormResult3 = $roleRelation->getContainer()->getModel()->getOrmDbTable();
        $ormResult3->where('`power_tag` LIKE ?', [$data['power_tag'] . '%']);
        $roleRelation->getContainer()->getModel()->delete($ormResult3);
        unset($ormResult3, $ormResult2, $ormResult1, $rolePower, $roleRelation);

        Role::clearRolePowerList();

        return [
            'msg' => '删除权限信息成功',
        ];
    }

    public static function editRolePowersByStation(array $data){
        $roleBase = SyBaseMysqlFactory::RoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['role_tag']]);
        $roleInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if(empty($roleInfo)){
            throw new CheckException('角色信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $roleRelation = SyBaseMysqlFactory::RoleRelationEntity();
        $ormResult2 = $roleRelation->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`role_tag`=?', [$data['role_tag']]);
        $roleRelation->getContainer()->getModel()->delete($ormResult2);

        if(!empty($data['role_powers'])){
            $nowTime = Tool::getNowTime();
            foreach ($data['role_powers'] as $eRolePower) {
                $roleRelation->getContainer()->getModel()->insert([
                    'role_tag' => $data['role_tag'],
                    'power_tag' => $eRolePower,
                    'created' => $nowTime,
                ]);
            }
        }
        unset($ormResult2, $ormResult1, $roleRelation, $roleBase);

        Role::clearRolePowerList($data['role_tag']);

        return [
            'msg' => '修改角色权限成功',
        ];
    }

    public static function getPowerListByStation(array $data){
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        if($data['level'] == Project::ROLE_POWER_LEVEL_ONE){
            $ormResult1->where('`level`=?', [Project::ROLE_POWER_LEVEL_ONE]);
        } else {
            $ormResult1->where('`tag` LIKE ? AND `level`=?', [$data['ptag'] . '%', $data['level'],]);
        }
        $ormResult1->order('`created` DESC,`tag` ASC');
        $powerList = $rolePower->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $powerList['total_level'] = Project::$totalRolePowerLevel;
        unset($ormResult1, $rolePower);

        return $powerList;
    }

    public static function getRolePowersByStation(array $data){
        $page = 1;
        $powerMap = [];
        $rolePower = SyBaseMysqlFactory::RolePowerEntity();
        $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->order('`tag` ASC');
        $powerList = $rolePower->getContainer()->getModel()->select($ormResult1, $page, 100);
        while (!empty($powerList)) {
            foreach ($powerList as $ePower) {
                $powerMap[$ePower['tag']] = $ePower;
                $powerMap[$ePower['tag']]['selected'] = 0;
            }

            $page++;
            $powerList = $rolePower->getContainer()->getModel()->select($ormResult1, $page, 100);
        }
        unset($powerList, $ormResult1, $rolePower);

        $page = 1;
        $roleRelation = SyBaseMysqlFactory::RoleRelationEntity();
        $ormResult2 = $roleRelation->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`role_tag`=?', [$data['role_tag']])
                   ->order('`power_tag` ASC');
        $relationList = $roleRelation->getContainer()->getModel()->select($ormResult2, $page, 100);
        while (!empty($relationList)) {
            foreach ($relationList as $eRelation) {
                $powerMap[$eRelation['power_tag']]['selected'] = 1;
            }

            $page++;
            $relationList = $roleRelation->getContainer()->getModel()->select($ormResult2, $page, 100);
        }
        unset($relationList, $ormResult2, $roleRelation);

        $resArr = [];
        foreach ($powerMap as $powerTag => $powerData) {
            if($powerData['level'] == Project::ROLE_POWER_LEVEL_ONE){
                $resArr[$powerTag] = [
                    'tag' => $powerTag,
                    'title' => $powerData['title'],
                    'icon' => $powerData['icon'],
                    'path' => $powerData['router_path'],
                    'selected' => $powerData['selected'],
                    'children' => [],
                ];
            } else if($powerData['level'] == Project::ROLE_POWER_LEVEL_TWO){
                $subTag = substr($powerTag, 0, 3);
                $resArr[$subTag]['children'][$powerTag] = [
                    'tag' => $powerTag,
                    'title' => $powerData['title'],
                    'icon' => $powerData['icon'],
                    'path' => $powerData['router_path'],
                    'selected' => $powerMap[$subTag]['selected'] == 1 ? 1 : $powerData['selected'],
                    'children' => [],
                ];
            } else {
                $subTag1 = substr($powerTag, 0, 3);
                $subTag2 = substr($powerTag, 0, 6);
                if($powerMap[$subTag1]['selected'] == 1){
                    $selectedStatus = 1;
                } else if($powerMap[$subTag2]['selected'] == 1){
                    $selectedStatus = 1;
                } else {
                    $selectedStatus = $powerMap[$powerTag]['selected'];
                }
                $resArr[$subTag1]['children'][$subTag2]['children'][$powerTag] = [
                    'tag' => $powerTag,
                    'title' => $powerData['title'],
                    'icon' => $powerData['icon'],
                    'path' => $powerData['router_path'],
                    'selected' => $selectedStatus,
                ];
            }
        }
        unset($powerMap);

        return array_values($resArr);
    }
}