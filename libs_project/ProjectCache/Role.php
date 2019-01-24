<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-6-23
 * Time: 下午11:35
 */
namespace ProjectCache;

use Constant\ErrorCode;
use Constant\Project;
use DesignPatterns\Factories\CacheSimpleFactory;
use Exception\Common\CheckException;
use Factories\SyBaseMysqlFactory;
use Tool\Tool;
use Traits\SimpleTrait;

class Role {
    use SimpleTrait;

    private static $roleListKey = Project::REDIS_PREFIX_ROLE_LIST . 'roles';

    public static function getRolePowerList(string $roleTag){
        $redisKey = Project::REDIS_PREFIX_ROLE_POWERS . $roleTag;
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll($redisKey);
        if(empty($cacheData)){
            $page = 1;
            $powerMap = [];
            $rolePower = SyBaseMysqlFactory::RolePowerEntity();
            $ormResult1 = $rolePower->getContainer()->getModel()->getOrmDbTable();
            $ormResult1->order('`level` ASC,`sort_num` DESC,`tag` ASC');
            $powerList = $rolePower->getContainer()->getModel()->select($ormResult1, $page, 100);
            while (!empty($powerList)) {
                foreach ($powerList as $ePower) {
                    $powerMap[$ePower['tag']] = $ePower;
                    $powerMap[$ePower['tag']]['selected'] = -1;
                }

                $page++;
                $powerList = $rolePower->getContainer()->getModel()->select($ormResult1, $page, 100);
            }
            unset($powerList, $ormResult1, $rolePower);

            $page = 1;
            $roleRelation = SyBaseMysqlFactory::RoleRelationEntity();
            $ormResult2 = $roleRelation->getContainer()->getModel()->getOrmDbTable();
            $ormResult2->where('`role_tag`=?', [$roleTag])
                       ->order('`power_tag` ASC');
            $relationList = $roleRelation->getContainer()->getModel()->select($ormResult2, $page, 100);
            while (!empty($relationList)) {
                foreach ($relationList as $eRelation) {
                    $powerMap[$eRelation['power_tag']]['selected'] = 1;
                    $tagLength = strlen($eRelation['power_tag']);
                    if($tagLength == 6){
                        $subTag = substr($eRelation['power_tag'], 0, 3);
                        $powerMap[$subTag]['selected'] = 0;
                    } else if($tagLength == 9){
                        $subTag1 = substr($eRelation['power_tag'], 0, 3);
                        $subTag2 = substr($eRelation['power_tag'], 0, 6);
                        $powerMap[$subTag1]['selected'] = 0;
                        $powerMap[$subTag2]['selected'] = 0;
                    }
                }

                $page++;
                $relationList = $roleRelation->getContainer()->getModel()->select($ormResult2, $page, 100);
            }
            unset($relationList, $ormResult2, $roleRelation);

            $savePowers = [];
            foreach ($powerMap as $powerTag => $powerData) {
                if($powerData['level'] == Project::ROLE_POWER_LEVEL_ONE){
                    if($powerData['selected'] != -1){
                        $savePowers[$powerTag] = [
                            'tag' => $powerTag,
                            'title' => $powerData['title'],
                            'icon' => $powerData['icon'],
                            'path' => $powerData['router_path'],
                            'children' => [],
                        ];
                    }
                } else if($powerData['level'] == Project::ROLE_POWER_LEVEL_TWO){
                    $subTag = substr($powerTag, 0, 3);
                    $selectedStatus = $powerData['selected'];
                    if($powerMap[$subTag]['selected'] == 1){
                        $selectedStatus = 1;
                    }
                    if($selectedStatus != -1){
                        $savePowers[$subTag]['children'][$powerTag] = [
                            'tag' => $powerTag,
                            'title' => $powerData['title'],
                            'icon' => $powerData['icon'],
                            'path' => $powerData['router_path'],
                            'children' => [],
                        ];
                    }
                } else {
                    $subTag1 = substr($powerTag, 0, 3);
                    $subTag2 = substr($powerTag, 0, 6);
                    $selectedStatus = $powerData['selected'];
                    if($powerMap[$subTag1]['selected'] == 1){
                        $selectedStatus = 1;
                    } else if($powerMap[$subTag2]['selected'] == 1){
                        $selectedStatus = 1;
                    }
                    if($selectedStatus != -1){
                        $savePowers[$subTag1]['children'][$subTag2]['children'][] = [
                            'tag' => $powerTag,
                            'title' => $powerData['title'],
                            'icon' => $powerData['icon'],
                            'path' => $powerData['router_path'],
                        ];
                    }
                }
            }
            unset($powerMap);

            $rolePowers = [];
            foreach ($savePowers as $eTag => $eData) {
                $saveData = $eData;
                $saveData['children'] = array_values($eData['children']);
                $rolePowers[] = $saveData;
            }
            unset($savePowers);

            $cacheData['unique_key'] = $redisKey;
            $cacheData['power_list'] = Tool::jsonEncode($rolePowers, JSON_UNESCAPED_UNICODE);
            CacheSimpleFactory::getRedisInstance()->hMset($redisKey, $cacheData);
            CacheSimpleFactory::getRedisInstance()->expire($redisKey, 7200);
            CacheSimpleFactory::getRedisInstance()->sAdd(self::$roleListKey, $roleTag);

            return $rolePowers;
        } else if(isset($cacheData['unique_key']) && ($cacheData['unique_key'] == $redisKey)){
            $rolePowers = Tool::jsonDecode($cacheData['power_list']);
            return is_array($rolePowers) ? $rolePowers : [];
        } else {
            throw new CheckException('获取角色权限信息缓存出错', ErrorCode::COMMON_SERVER_ERROR);
        }
    }

    public static function clearRolePowerList(string $roleTag=''){
        if(strlen($roleTag) > 0){
            $redisKey = Project::REDIS_PREFIX_ROLE_POWERS . $roleTag;
            CacheSimpleFactory::getRedisInstance()->del($redisKey);
        } else {
            $roles = CacheSimpleFactory::getRedisInstance()->sMembers(self::$roleListKey);
            foreach ($roles as $eRoleTag) {
                $redisKey = Project::REDIS_PREFIX_ROLE_POWERS . $eRoleTag;
                CacheSimpleFactory::getRedisInstance()->del($redisKey);
            }
            CacheSimpleFactory::getRedisInstance()->del(self::$roleListKey);
        }
    }
}