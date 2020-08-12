<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/8 0008
 * Time: 12:24
 */
namespace ProjectCache;

use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

/**
 * Class PermissionRole
 *
 * @package ProjectCache
 */
class PermissionRole
{
    use SimpleTrait;

    /**
     * 获取缓存数据
     *
     * @param string $roleTag
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function getCacheData(string $roleTag)
    {
        $redisKey = self::getCacheKey($roleTag);
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (!isset($cacheData['list'])) {
            $cacheData = [
                'unique_key' => $redisKey,
            ];

            $permissionList = self::getPermissionList($roleTag);
            $cacheData['list'] = Tool::jsonEncode($permissionList, JSON_UNESCAPED_UNICODE);
            unset($permissionList);

            CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, $cacheData);
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);
        }

        if ($cacheData['unique_key'] == $redisKey) {
            $permissionList = Tool::jsonDecode($cacheData['list']);

            return is_array($permissionList) ? $permissionList : [];
        }

        throw new CheckException('获取角色权限列表缓存出错,请稍后重试', ErrorCode::COMMON_SERVER_ERROR);
    }

    /**
     * 清理缓存数据
     *
     * @param string $roleTag
     *
     * @return int
     */
    public static function clearCacheData(string $roleTag)
    {
        if (strlen($roleTag) > 0) {
            $redisKey = self::getCacheKey($roleTag);

            return CacheSimpleFactory::getRedisInstance()->del($redisKey);
        }
        $redisKey = Project::REDIS_PREFIX_PERMISSION_ROLE . '*';
        $keyList = CacheSimpleFactory::getRedisInstance()->keys($redisKey);
        foreach ($keyList as $eKey) {
            CacheSimpleFactory::getRedisInstance()->del($eKey);
        }

        return count($keyList);
    }

    /**
     * 获取缓存键名
     *
     * @param string $roleTag
     *
     * @return string
     */
    private static function getCacheKey(string $roleTag)
    {
        return Project::REDIS_PREFIX_PERMISSION_ROLE . $roleTag;
    }

    private static function getSelectedPermissions(string $roleTag, array $totalPermissions)
    {
        $rolePermissions = [];
        $page = 1;
        $rolePermission = SyBaseMysqlFactory::getRolePermissionEntity();
        $ormResult1 = $rolePermission->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`role_tag`=?', [$roleTag]);
        $permissionList = $rolePermission->getContainer()->getModel()->select($ormResult1, $page, 100);
        while (count($permissionList) > 0) {
            foreach ($permissionList as $ePermission) {
                for ($i = 3; $i <= 9; $i += 3) {
                    $nowTag = substr($ePermission['permission_tag'], 0, $i);
                    if ($nowTag === $ePermission['permission_tag']) {
                        $rolePermissions[$nowTag] = 1;

                        break;
                    }
                    $parentTag = substr($ePermission['permission_tag'], 0, ($i - 3));
                    $rolePermissions[$nowTag] = $rolePermissions[$parentTag] ?? 2;
                }
            }
            $page++;
            $permissionList = $rolePermission->getContainer()->getModel()->select($ormResult1, $page, 100);
        }
        unset($permissionList, $ormResult1, $rolePermission);

        $selectedPermissions = [];
        foreach ($totalPermissions as $tag => $info) {
            $existTag = 0;
            for ($j = 3; $j <= 9; $j += 3) {
                $needTag = substr($tag, 0, $j);
                $existTag = $rolePermissions[$needTag] ?? 0;
                if (($existTag != 2) || ($needTag === $tag)) {
                    break;
                }
            }
            if ($existTag != 0) {
                $selectedPermissions[$tag] = $info;
            }
        }

        return $selectedPermissions;
    }

    private static function getPermissionList(string $roleTag)
    {
        $permissions = [];
        $page = 1;
        $permissionBase = SyBaseMysqlFactory::getPermissionBaseEntity();
        $ormResult1 = $permissionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->order('`level_num` ASC,`sort_num` DESC,`tag` ASC');
        $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult1, $page, 100);
        while (count($permissionList) > 0) {
            foreach ($permissionList as $ePermission) {
                $needLength = strlen($ePermission['tag']) - 3;
                $prefixTag = $needLength > 0 ? substr($ePermission['tag'], 0, $needLength) : '';
                if ((strlen($prefixTag) > 0) && !isset($permissions[$prefixTag])) {
                    continue;
                }

                $permissions[$ePermission['tag']] = [
                    'title' => $ePermission['title'],
                    'node' => $ePermission['node_type'],
                    'level' => $ePermission['level_num'],
                    'icon' => $ePermission['path_icon'],
                    'redirect' => $ePermission['path_redirect'],
                    'extend' => [],
                ];
                if (strlen($ePermission['extend_data']) > 0) {
                    $extendData = Tool::jsonDecode($ePermission['extend_data']);
                    if (is_array($extendData)) {
                        $permissions[$ePermission['tag']]['extend'] = $extendData;
                    }
                }
            }
            $page++;
            $permissionList = $permissionBase->getContainer()->getModel()->select($ormResult1, $page, 100);
        }
        unset($permissionList, $ormResult1, $permissionBase);

        $truePermissions = self::getSelectedPermissions($roleTag, $permissions);
        unset($permissions);

        return $truePermissions;
    }
}
