<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:22
 */
namespace Dao;

use Factories\SyBaseMysqlFactory;
use ProjectCache\PermissionRole;
use ProjectCache\PermissionUser;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class PermissionBaseDao
{
    use SimpleDaoTrait;

    public static function addInfoByStation(array $data)
    {
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        if ($data['level_num'] > Project::PERMISSION_LEVEL_ONE) {
            $ormResult1->where('tag', [$data['ptag'], $data['tag']])
                       ->order('`tag` ASC');
            $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult1, 1, 10);
            if (empty($permissionList)) {
                throw new CheckException('上级权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (count($permissionList) > 1) {
                throw new CheckException('已存在相同标识的权限', ErrorCode::COMMON_PARAM_ERROR);
            }

            $permissionInfo = $permissionList[0];
            if ($permissionInfo['tag'] == $data['tag']) {
                throw new CheckException('已存在相同标识的权限', ErrorCode::COMMON_PARAM_ERROR);
            }
            if ($permissionInfo['node_type'] == Project::PERMISSION_NODE_TYPE_LEAF) {
                throw new CheckException('叶子节点权限不允许添加子权限', ErrorCode::COMMON_PARAM_ERROR);
            }
        } else {
            $ormResult1->where('`tag`=?', [$data['tag']]);
            $permissionInfo = $permissionBase->getContainer()->getModel()->findOne($ormResult1);
            if (!empty($permissionInfo)) {
                throw new CheckException('已存在相同标识的权限', ErrorCode::COMMON_PARAM_ERROR);
            }
        }

        $nowTime = Tool::getNowTime();
        $permissionBase->tag = $data['tag'];
        $permissionBase->node_type = $data['node_type'];
        $permissionBase->level_num = $data['level_num'];
        $permissionBase->title = $data['title'];
        $permissionBase->path_icon = $data['path_icon'];
        $permissionBase->path_redirect = $data['path_redirect'];
        $permissionBase->sort_num = $data['sort_num'];
        $permissionBase->extend_data = '{}';
        $permissionBase->created = $nowTime;
        $permissionBase->updated = $nowTime;
        $permissionId = $permissionBase->getContainer()->getModel()->insert($permissionBase->getEntityDataArray());
        if (!$permissionId) {
            throw new CheckException('添加权限信息失败,请稍候重试', ErrorCode::COMMON_SERVER_ERROR);
        }
        unset($ormResult1, $permissionBase);

        PermissionRole::clearCacheData('');
        PermissionUser::clearCacheData('');

        return [
            'permission_tag' => $data['tag'],
        ];
    }

    public static function getInfoByStation(array $data)
    {
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['permission_tag']]);
        $permissionInfo = $permissionBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($permissionInfo)) {
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        $powerInfo['total_level'] = Project::$totalPermissionLevel;
        unset($ormResult1, $permissionBase);

        return $powerInfo;
    }

    public static function editInfoByStation(array $data)
    {
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['permission_tag']]);
        $permissionInfo = $permissionBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($permissionInfo)) {
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $permissionBase->getContainer()->getModel()->update($ormResult1, [
            'title' => $data['title'],
            'path_icon' => $data['path_icon'],
            'path_redirect' => $data['path_redirect'],
            'sort_num' => $data['sort_num'],
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $permissionBase);

        PermissionRole::clearCacheData('');
        PermissionUser::clearCacheData('');

        return [
            'msg' => '修改权限信息成功',
        ];
    }

    public static function delInfoByStation(array $data)
    {
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['permission_tag']]);
        $permissionInfo = $permissionBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($permissionInfo)) {
            throw new CheckException('权限信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ormResult2 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag` LIKE ?', [$data['permission_tag'] . '%']);
        $permissionBase->getContainer()->getModel()->delete($ormResult2);

        $rolePermission = SyBaseMysqlFactory::getRolePermissionEntity();
        $ormResult3 = $rolePermission->getContainer()->getModel()->getOrmDbTable();
        $ormResult3->where('`permission_tag` LIKE ?', [$data['permission_tag'] . '%']);
        $rolePermission->getContainer()->getModel()->delete($ormResult3);
        unset($ormResult3, $ormResult2, $ormResult1, $permissionBase, $rolePermission);

        PermissionRole::clearCacheData('');
        PermissionUser::clearCacheData('');

        return [
            'msg' => '删除权限信息成功',
        ];
    }

    public static function getListByStation(array $data)
    {
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        if ($data['level_num'] == Project::PERMISSION_LEVEL_ONE) {
            $ormResult1->where('`level_num`=?', [Project::PERMISSION_LEVEL_ONE]);
        } else {
            $ormResult1->where('`tag` LIKE ? AND `level_num`=?', [$data['ptag'] . '%', $data['level_num']]);
        }
        $ormResult1->order('`created` DESC,`tag` ASC');
        $permissionList = $permissionBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $permissionList['total_level'] = Project::$totalPermissionLevel;
        unset($ormResult1, $permissionBase);

        return $permissionList;
    }
}
