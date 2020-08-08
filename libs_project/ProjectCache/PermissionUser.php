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
class PermissionUser
{
    use SimpleTrait;

    /**
     * 获取缓存数据
     *
     * @param string $userId
     *
     * @return array
     *
     * @throws \SyException\Common\CheckException
     */
    public static function getCacheData(string $userId)
    {
        $redisKey = self::getCacheKey($userId);
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if (!isset($cacheData['list'])) {
            $cacheData = [
                'unique_key' => $redisKey,
            ];

            $permissionList = self::getPermissionList($userId);
            $cacheData['list'] = Tool::jsonEncode($permissionList, JSON_UNESCAPED_UNICODE);
            unset($permissionList);

            CacheSimpleFactory::getRedisInstance()->hMSet($redisKey, $cacheData);
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, 86400);
        }

        if ($cacheData['unique_key'] == $redisKey) {
            $permissionList = Tool::jsonDecode($cacheData['list']);

            return is_array($permissionList) ? $permissionList : [];
        }

        throw new CheckException('获取用户权限列表缓存出错,请稍后重试', ErrorCode::COMMON_SERVER_ERROR);
    }

    /**
     * 清理缓存数据
     *
     * @param string $userId
     *
     * @return int
     */
    public static function clearCacheData(string $userId)
    {
        if (strlen($userId) > 0) {
            $redisKey = self::getCacheKey($userId);

            return CacheSimpleFactory::getRedisInstance()->del($redisKey);
        }
        $redisKey = Project::REDIS_PREFIX_PERMISSION_USER . '*';
        $keyList = CacheSimpleFactory::getRedisInstance()->keys($redisKey);
        foreach ($keyList as $eKey) {
            CacheSimpleFactory::getRedisInstance()->del($eKey);
        }

        return count($keyList);
    }

    /**
     * 获取缓存键名
     *
     * @param string $userId
     *
     * @return string
     */
    private static function getCacheKey(string $userId)
    {
        return Project::REDIS_PREFIX_PERMISSION_USER . $userId;
    }

    private static function getUserPermissions(string $userId)
    {
        $roles = [];
        $userRole = SyBaseMysqlFactory::getUserRoleEntity();
        $ormResult1 = $userRole->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`user_id`=?', [$userId]);
        $roleList = $userRole->getContainer()->getModel()->select($ormResult1);
        foreach ($roleList as $eRole) {
            $roles[$eRole['role_tag']] = 1;
        }
        unset($roleList, $ormResult1, $userRole);

        $permissions = [];
        $roleBase = SyBaseMysqlFactory::getRoleBaseEntity();
        $ormResult2 = $roleBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`status`=?', [Project::ROLE_STATUS_VALID])
                   ->where('tag', array_keys($roles));
        $roleList = $roleBase->getContainer()->getModel()->select($ormResult2);
        foreach ($roleList as $eRole) {
            $permissionList = PermissionRole::getCacheData($eRole['tag']);
            $permissions = array_merge($permissions, $permissionList);
        }
        unset($permissionList, $roleList, $ormResult2, $roleBase);

        return $permissions;
    }

    private static function getPermissionList(string $userId)
    {
        $permissions = [];
        $permissionList = self::getUserPermissions($userId);
        foreach ($permissionList as $eTag => $eInfo) {
            $tagArr = str_split($eTag, 3);
            $info = $eInfo;
            $info['tag'] = $eTag;
            if ($info['node'] == Project::PERMISSION_NODE_TYPE_FORK) {
                $info['children'] = [];
            }
            switch ($eInfo['level']) {
                case Project::PERMISSION_LEVEL_ONE:
                    $permissions[$tagArr[0]] = $info;

                    break;
                case Project::PERMISSION_LEVEL_TWO:
                    $permissions[$tagArr[0]]['children'][$tagArr[1]] = $info;

                    break;
                default:
                    $permissions[$tagArr[0]]['children'][$tagArr[1]]['children'][] = $info;
            }
        }

        return array_values($permissions);
    }
}
