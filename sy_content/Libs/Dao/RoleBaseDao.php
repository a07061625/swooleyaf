<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/6/23 0023
 * Time: 9:21
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

class RoleBaseDao
{
    use SimpleDaoTrait;

    public static function addInfoByStation(array $data)
    {
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if (!empty($roleBaseInfo)) {
            throw new CheckException('标识已存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $nowTime = Tool::getNowTime();
        $roleBase->tag = $data['tag'];
        $roleBase->title = $data['title'];
        $roleBase->status = Project::ROLE_STATUS_VALID;
        $roleBase->created = $nowTime;
        $roleBase->updated = $nowTime;
        $roleId = $roleBase->getContainer()->getModel()->insert($roleBase->getEntityDataArray());
        if (!$roleId) {
            throw new CheckException('添加角色失败', ErrorCode::COMMON_SERVER_ERROR);
        }
        unset($ormResult1, $roleBase);

        return [
            'role_tag' => $data['tag'],
        ];
    }

    public static function editInfoByStation(array $data)
    {
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($roleBaseInfo)) {
            throw new CheckException('角色信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $roleBase->getContainer()->getModel()->update($ormResult1, [
            'title' => $data['title'],
            'updated' => Tool::getNowTime(),
        ]);
        unset($ormResult1, $roleBase);

        return [
            'msg' => '修改角色信息成功',
        ];
    }

    public static function getInfoByStation(array $data)
    {
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['role_tag']]);
        $roleBaseInfo = $roleBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($roleBaseInfo)) {
            throw new CheckException('角色信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        $roleBaseInfo['total_status'] = Project::$totalRoleStatus;
        unset($ormResult1, $roleBase);

        return $roleBaseInfo;
    }

    public static function getListByStation(array $data)
    {
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        if ($data['role_status'] > -2) {
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

    public static function editRolePermissionsByStation(array $data)
    {
        $permissionArr = [];
        if (count($data['permission_list']) > 0) {
            $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
            $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
            $ormResult1->where('tag', $data['permission_list']);
            $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult1);
            foreach ($permissionList as $ePermission) {
                $permissionArr[] = $ePermission['tag'];
            }
            unset($permissionList, $ormResult1, $permissionBase);
        }

        //删除旧权限
        $rolePermission = SyBaseMysqlFactory::getRolePermissionEntity();
        $ormResult2 = $rolePermission->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`role_tag`=?', [$data['role_tag']]);
        $rolePermission->getContainer()->getModel()->delete($ormResult2);

        if (count($permissionArr) > 0) {
            $insertData = [];
            $nowTime = Tool::getNowTime();
            foreach ($permissionArr as $eTag) {
                $insertData[] = [
                    'role_tag' => $data['role_tag'],
                    'permission_tag' => $eTag,
                    'created_at' => $nowTime,
                ];
            }

            $ormResult3 = $rolePermission->getContainer()->getModel()->getOrmDbTable();
            $ormResult3->insert_multi($insertData);
        }
        PermissionRole::clearCacheData($data['role_tag']);
        PermissionUser::clearCacheData('');

        return [
            'msg' => '修改角色权限列表成功',
        ];
    }

    public static function getRolePermissionsByStation(array $data)
    {
        $permissionTags = [];
        $rolePermission = SyBaseMysqlFactory::getRolePermissionEntity();
        $ormResult1 = $rolePermission->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`role_tag`=?', [$data['role_tag']])
                   ->order('`permission_tag` ASC');
        $permissionList = $rolePermission->getContainer()->getModel()->select($ormResult1, 1, 1000);
        foreach ($permissionList as $ePermission) {
            for ($i = 9; $i > 0; $i -= 3) {
                $subTag = substr($ePermission['permission_tag'], 0, $i);
                $permissionTags[$subTag] = $subTag === $ePermission['permission_tag'] ? 1 : 2;
            }
        }
        unset($permissionList, $ormResult1, $rolePermission);

        //返回zTree需要的数据格式
        $totalPermissions = [];
        $page = 1;
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult2 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->order('`level_num` ASC,`sort_num` DESC,`tag` ASC');
        $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult2, $page, 200);
        while (count($permissionList) > 0) {
            foreach ($permissionList as $ePermission) {
                $totalPermissions[$ePermission['tag']] = [
                    'id' => $ePermission['id'],
                    'tag' => $ePermission['tag'],
                    'title' => $ePermission['title'],
                ];
                if (isset($permissionTags[$ePermission['tag']])) {
                    $totalPermissions[$ePermission['tag']]['checked'] = true;
                    if ($permissionTags[$ePermission['tag']] == 2) {
                        $totalPermissions[$ePermission['tag']]['halfCheck'] = true;
                    }
                }
                if ($ePermission['level_num'] == Project::PERMISSION_LEVEL_ONE) {
                    $totalPermissions[$ePermission['tag']]['pid'] = 0;
                } else {
                    $needLength = strlen($ePermission['tag']) - 3;
                    $prefixTag = substr($ePermission['tag'], 0, $needLength);
                    if (!isset($totalPermissions[$prefixTag])) {
                        continue;
                    }
                    if ((!isset($totalPermissions[$ePermission['tag']]['checked']))
                        && isset($totalPermissions[$prefixTag]['checked'])
                        && (!isset($totalPermissions[$prefixTag]['halfCheck']))) {
                        $totalPermissions[$ePermission['tag']]['checked'] = true;
                    }
                    $totalPermissions[$ePermission['tag']]['pid'] = $totalPermissions[$prefixTag]['id'];
                }
                if ($ePermission['node_type'] == Project::PERMISSION_NODE_TYPE_FORK) {
                    $totalPermissions[$ePermission['tag']]['isParent'] = true;
                }
            }

            $page++;
            $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult2, $page, 200);
        }
        unset($permissionList, $ormResult2, $permissionBase);

        return array_values($totalPermissions);
    }

    public static function getListByFront(array $data)
    {
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult1 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`status`=?', [Project::ROLE_STATUS_VALID])
                   ->order('`tag` ASC');
        $roleList = $roleBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $roleList['total_status'] = Project::$totalRoleStatus;
        unset($ormResult1, $roleBase);

        return $roleList;
    }
}
