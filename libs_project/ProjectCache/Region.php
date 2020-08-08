<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/31 0031
 * Time: 19:36
 */
namespace ProjectCache;

use DesignPatterns\Factories\CacheSimpleFactory;
use Factories\SyBaseMysqlFactory;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleTrait;

class Region
{
    use SimpleTrait;

    private static $listKey = Project::REDIS_PREFIX_REGION_LIST . 'regions';
    private static $regionList = [];
    private static $refreshTime = 0;

    public static function getRegionList(string $provinceCode = '')
    {
        $nowTime = Tool::getNowTime();
        if ($nowTime >= self::$refreshTime) {
            self::refreshRegionList();
        }

        if (strlen($provinceCode) > 0) {
            return self::$regionList[$provinceCode] ?? [];
        }

        return array_values(self::$regionList);
    }

    public static function clearRegionList()
    {
        CacheSimpleFactory::getRedisInstance()->del(self::$listKey);
        self::$regionList = [];
    }

    private static function refreshRegionList()
    {
        $cacheData = CacheSimpleFactory::getRedisInstance()->hGetAll(self::$listKey);
        if (empty($cacheData)) {
            $cacheData['unique_key'] = self::$listKey;
            $page = 1;
            $cityArr = [];
            $provinceArr = [];
            $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
            $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
            $ormResult1->order('`tag` ASC');
            $regions = $regionBase->getContainer()->getModel()->setFields([
                'tag',
                'level',
                'title',
            ])->select($ormResult1, $page, 100);
            while (!empty($regions)) {
                foreach ($regions as $eRegion) {
                    if ($eRegion['level'] == Project::REGION_LEVEL_TYPE_PROVINCE) {
                        $provinceArr[$eRegion['tag']] = [
                            'tag' => $eRegion['tag'],
                            'title' => $eRegion['title'],
                            'children' => [],
                        ];
                    } elseif ($eRegion['level'] == Project::REGION_LEVEL_TYPE_CITY) {
                        $cityArr[$eRegion['tag']] = [
                            'tag' => $eRegion['tag'],
                            'title' => $eRegion['title'],
                            'children' => [],
                        ];
                    } else {
                        $cityTag = substr($eRegion['tag'], 0, 6);
                        $cityArr[$cityTag]['children'][] = [
                            'tag' => $eRegion['tag'],
                            'title' => $eRegion['title'],
                        ];
                    }
                }

                $page++;
                $regions = $regionBase->getContainer()->getModel()->setFields([
                    'tag',
                    'level',
                    'title',
                ])->select($ormResult1, $page, 100);
            }
            unset($regions, $ormResult1, $regionBase);

            foreach ($cityArr as $cityTag => $cityRegions) {
                $provinceTag = substr($cityTag, 0, 3);
                $provinceArr[$provinceTag]['children'][] = $cityRegions;
            }
            unset($cityRegions, $cityArr);

            self::$regionList = $provinceArr;
            foreach ($provinceArr as $provinceTag => $provinceRegions) {
                $cacheData[$provinceTag] = Tool::jsonEncode($provinceRegions, JSON_UNESCAPED_UNICODE);
            }
            unset($provinceRegions, $provinceArr);

            CacheSimpleFactory::getRedisInstance()->hMset(self::$listKey, $cacheData);
            CacheSimpleFactory::getRedisInstance()->expire(self::$listKey, 86400);
            self::$refreshTime = Tool::getNowTime() + 600;
        } elseif (isset($cacheData['unique_key']) && ($cacheData['unique_key'] == self::$listKey)) {
            unset($cacheData['unique_key']);
            self::$regionList = [];
            foreach ($cacheData as $provinceTag => $provinceRegions) {
                self::$regionList[$provinceTag] = Tool::jsonDecode($provinceRegions);
            }
            self::$refreshTime = Tool::getNowTime() + 600;
        } else {
            throw new CheckException('获取地区信息缓存出错', ErrorCode::COMMON_PARAM_ERROR);
        }
    }
}
