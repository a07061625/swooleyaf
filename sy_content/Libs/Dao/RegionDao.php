<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/5/30 0030
 * Time: 17:07
 */
namespace Dao;

use Factories\SyBaseMysqlFactory;
use ProjectCache\Region;
use SyConstant\ErrorCode;
use SyConstant\Project;
use SyException\Common\CheckException;
use SyTool\Tool;
use SyTrait\SimpleDaoTrait;

class RegionDao
{
    use SimpleDaoTrait;

    private static $addStationRegionMap = [
        Project::REGION_LEVEL_TYPE_PROVINCE => 'addProvinceRegionByStation',
        Project::REGION_LEVEL_TYPE_CITY => 'addCityRegionByStation',
        Project::REGION_LEVEL_TYPE_COUNTY => 'addCountyRegionByStation',
    ];
    private static $editStationRegionMap = [
        Project::REGION_LEVEL_TYPE_PROVINCE => 'editProvinceRegionByStation',
        Project::REGION_LEVEL_TYPE_CITY => 'editCityRegionByStation',
        Project::REGION_LEVEL_TYPE_COUNTY => 'editCountyRegionByStation',
    ];

    public static function addRegionByStation(array $data)
    {
        $funcName = Tool::getArrayVal(self::$addStationRegionMap, $data['region_level'], null);
        if (is_null($funcName)) {
            throw new CheckException('地区级别不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr = self::$funcName($data);
        Region::clearRegionList();

        return $resArr;
    }

    public static function editRegionByStation(array $data)
    {
        $funcName = Tool::getArrayVal(self::$editStationRegionMap, $data['region_level'], null);
        if (is_null($funcName)) {
            throw new CheckException('地区级别不支持', ErrorCode::COMMON_PARAM_ERROR);
        }

        $resArr = self::$funcName($data);
        Region::clearRegionList();

        return $resArr;
    }

    public static function deleteRegionByStation(array $data)
    {
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag` LIKE ?', [$data['region_tag'] . '%'])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 10);
        if (empty($regionInfo)) {
            throw new CheckException('地区信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif ($regionList[0]['tag'] != $data['region_tag']) {
            throw new CheckException('地区信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif ($regionList[0]['level'] == Project::REGION_LEVEL_TYPE_PROVINCE) {
            throw new CheckException('不允许删除省地区', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (count($regionList) > 1) {
            throw new CheckException('存在子地区,不允许删除', ErrorCode::COMMON_PARAM_ERROR);
        }

        //删除地区信息
        $ormResult2 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag`=?', [$data['region_tag']]);
        $regionBase->getContainer()->getModel()->delete($ormResult2);
        unset($ormResult2, $ormResult1, $regionBase);

        Region::clearRegionList();

        return [
            'msg' => '删除地区信息成功',
        ];
    }

    public static function getRegionInfoByStation(array $data)
    {
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=? AND `level`=?', [$data['region_tag'], $data['region_level']]);
        $regionInfo = $regionBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($regionInfo)) {
            throw new CheckException('地区信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        unset($ormResult1, $regionBase);
        $regionInfo['total_leveltype'] = Project::$totalRegionLevelType;

        return $regionInfo;
    }

    public static function getRegionListByStation(array $data)
    {
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`level`=?', [$data['region_level']]);
        if (strlen($data['region_ptag']) > 0) {
            $ormResult1->where('`tag` LIKE ?', [$data['region_ptag'] . '%']);
        }
        $ormResult1->order('`sort` DESC,`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->findPage($ormResult1, $data['page'], $data['limit']);
        $regionList['total_level'] = Project::$totalRegionLevelType;
        unset($ormResult1, $regionBase);

        return $regionList;
    }

    public static function getRegionInfoByFront(array $data)
    {
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag`=?', [$data['region_tag']]);
        $regionInfo = $regionBase->getContainer()->getModel()->findOne($ormResult1);
        if (empty($regionInfo)) {
            throw new CheckException('地区信息不存在', ErrorCode::COMMON_PARAM_ERROR);
        }
        unset($ormResult1, $regionBase);

        return $regionInfo;
    }

    private static function addProvinceRegionByStation(array &$data)
    {
        $needNum = 1001;
        $needTag = '';
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`level`=?', [Project::REGION_LEVEL_TYPE_PROVINCE])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        foreach ($regionList as $eRegion) {
            if ($eRegion['title'] == $data['region_name']) {
                throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
            }
            if (strlen($needTag) == 0) {
                $provinceTag = substr($needNum, 1);
                if ($eRegion['tag'] == $provinceTag) {
                    $needNum++;
                } else {
                    $needTag = $provinceTag;
                }
            }
        }
        if (strlen($needTag) == 0) {
            throw new CheckException('地区数量已达上限', ErrorCode::COMMON_PARAM_ERROR);
        }

        $regionBase->tag = $needTag;
        $regionBase->level = Project::REGION_LEVEL_TYPE_PROVINCE;
        $regionBase->title = $data['region_name'];
        $regionBase->sort = $data['region_sort'];
        $regionBase->getContainer()->getModel()->insert($regionBase->getEntityDataArray());
        unset($ormResult1, $regionBase);

        return [
            'region_tag' => $needTag,
        ];
    }

    private static function addCityRegionByStation(array &$data)
    {
        $parentTag = trim(\Request\SyRequest::getParams('region_ptag'));
        if (strlen($parentTag) != 3) {
            throw new CheckException('父地区标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
        $data['region_ptag'] = $parentTag;

        $needNum = 1001;
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag` LIKE ?', [$data['region_ptag'] . '%'])
                   ->where('level', [Project::REGION_LEVEL_TYPE_PROVINCE, Project::REGION_LEVEL_TYPE_CITY])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        if (empty($regionList)) {
            throw new CheckException('省地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (count($regionList) == 1) {
            $needTag = $data['region_ptag'] . '001';
        } else {
            $needTag = '';
            unset($regionList[0]);
            foreach ($regionList as $eRegion) {
                if ($eRegion['title'] == $data['region_name']) {
                    throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
                }

                if (strlen($needTag) == 0) {
                    $subTag = $data['region_ptag'] . substr($needNum, 1);
                    if ($eRegion['tag'] == $subTag) {
                        $needNum++;
                    } else {
                        $needTag = $subTag;
                    }
                }
            }
        }
        unset($regionList);

        if (strlen($needTag) == 0) {
            throw new CheckException('地区数量已达上限', ErrorCode::COMMON_PARAM_ERROR);
        }

        $regionBase->tag = $needTag;
        $regionBase->level = Project::REGION_LEVEL_TYPE_CITY;
        $regionBase->title = $data['region_name'];
        $regionBase->sort = $data['region_sort'];
        $regionBase->getContainer()->getModel()->insert($regionBase->getEntityDataArray());
        unset($ormResult1, $regionBase);

        return [
            'region_tag' => $needTag,
        ];
    }

    private static function addCountyRegionByStation(array &$data)
    {
        $parentTag = trim(\Request\SyRequest::getParams('region_ptag'));
        if (strlen($parentTag) != 6) {
            throw new CheckException('父地区标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
        $data['region_ptag'] = $parentTag;

        $needNum = 1001;
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`code` LIKE ?', [$data['region_ptag'] . '%'])
                   ->where('level', [Project::REGION_LEVEL_TYPE_CITY, Project::REGION_LEVEL_TYPE_COUNTY])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        if (empty($regionList)) {
            throw new CheckException('市地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        } elseif (count($regionList) == 1) {
            $needTag = $data['region_ptag'] . '001';
        } else {
            $needTag = '';
            unset($regionList[0]);
            foreach ($regionList as $eRegion) {
                if ($eRegion['title'] == $data['region_name']) {
                    throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
                }

                if (strlen($needTag) == 0) {
                    $subTag = $data['region_ptag'] . substr($needNum, 1);
                    if ($eRegion['tag'] == $subTag) {
                        $needNum++;
                    } else {
                        $needTag = $subTag;
                    }
                }
            }
        }
        unset($regionList);

        if (strlen($needTag) == 0) {
            throw new CheckException('地区数量已达上限', ErrorCode::COMMON_PARAM_ERROR);
        }

        $regionBase->tag = $needTag;
        $regionBase->level = Project::REGION_LEVEL_TYPE_COUNTY;
        $regionBase->title = $data['region_name'];
        $regionBase->sort = $data['region_sort'];
        $regionBase->getContainer()->getModel()->insert($regionBase->getEntityDataArray());
        unset($ormResult1, $regionBase);

        return [
            'region_tag' => $needTag,
        ];
    }

    private static function editProvinceRegionByStation(array &$data)
    {
        $regionTag = trim(\Request\SyRequest::getParams('region_tag'));
        if (strlen($regionTag) != 3) {
            throw new CheckException('地区标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
        $data['region_tag'] = $regionTag;
        
        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`level`=?', [Project::REGION_LEVEL_TYPE_PROVINCE])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        if (empty($regionList)) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $updateParams = [
            'sort' => $data['region_sort'],
        ];
        if (strlen($data['region_name']) > 0) {
            $updateParams['title'] = $data['region_name'];
        }

        $existRegion = false;
        if (strlen($data['region_name']) > 0) {
            foreach ($regionList as $eRegion) {
                if (($eRegion['title'] == $data['region_name']) && ($eRegion['tag'] != $data['region_tag'])) {
                    throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
                }
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;
                }
            }
        } else {
            foreach ($regionList as $eRegion) {
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;

                    break;
                }
            }
        }
        unset($regionList);

        if (!$existRegion) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ormResult2 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag`=?', [$data['region_tag']]);
        $regionBase->getContainer()->getModel()->update($ormResult2, $updateParams);
        unset($ormResult2, $ormResult1, $regionBase);

        return [
            'msg' => '修改地区信息成功',
        ];
    }

    private static function editCityRegionByStation(array &$data)
    {
        $regionTag = trim(\Request\SyRequest::getParams('region_tag'));
        if (strlen($regionTag) != 6) {
            throw new CheckException('地区标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
        $data['region_tag'] = $regionTag;

        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag` LIKE ? AND `level`=?', [substr($data['region_tag'], 0, 3) . '%', Project::REGION_LEVEL_TYPE_CITY])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        if (empty($regionList)) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $updateParams = [
            'sort' => $data['region_sort'],
        ];
        if (strlen($data['region_name']) > 0) {
            $updateParams['title'] = $data['region_name'];
        }

        $existRegion = false;
        if (strlen($data['region_name']) > 0) {
            foreach ($regionList as $eRegion) {
                if (($eRegion['title'] == $data['region_name']) && ($eRegion['tag'] != $data['region_tag'])) {
                    throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
                }
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;
                }
            }
        } else {
            foreach ($regionList as $eRegion) {
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;

                    break;
                }
            }
        }
        unset($regionList);

        if (!$existRegion) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ormResult2 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag`=?', [$data['region_tag']]);
        $regionBase->getContainer()->getModel()->update($ormResult2, $updateParams);
        unset($ormResult2, $ormResult1, $regionBase);

        return [
            'msg' => '修改地区信息成功',
        ];
    }

    private static function editCountyRegionByStation(array &$data)
    {
        $regionTag = trim(\Request\SyRequest::getParams('region_tag'));
        if (strlen($regionTag) != 9) {
            throw new CheckException('地区标识不合法', ErrorCode::COMMON_PARAM_ERROR);
        }
        $data['region_tag'] = $regionTag;

        $regionBase = SyBaseMysqlFactory::getRegionBaseEntity();
        $ormResult1 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult1->where('`tag` LIKE ? AND `level`=?', [substr($data['region_tag'], 0, 6) . '%', Project::REGION_LEVEL_TYPE_COUNTY])
                   ->order('`tag` ASC');
        $regionList = $regionBase->getContainer()->getModel()->select($ormResult1, 1, 1000);
        if (empty($regionList)) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $updateParams = [
            'sort' => $data['region_sort'],
        ];
        if (strlen($data['region_name']) > 0) {
            $updateParams['title'] = $data['region_name'];
        }

        $existRegion = false;
        if (strlen($data['region_name']) > 0) {
            foreach ($regionList as $eRegion) {
                if (($eRegion['title'] == $data['region_name']) && ($eRegion['tag'] != $data['region_tag'])) {
                    throw new CheckException('已存在同名的地区', ErrorCode::COMMON_PARAM_ERROR);
                }
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;
                }
            }
        } else {
            foreach ($regionList as $eRegion) {
                if ($eRegion['tag'] == $data['region_tag']) {
                    $existRegion = true;

                    break;
                }
            }
        }
        unset($regionList);

        if (!$existRegion) {
            throw new CheckException('地区不存在', ErrorCode::COMMON_PARAM_ERROR);
        }

        $ormResult2 = $regionBase->getContainer()->getModel()->getOrmDbTable();
        $ormResult2->where('`tag`=?', [$data['region_tag']]);
        $regionBase->getContainer()->getModel()->update($ormResult2, $updateParams);
        unset($ormResult2, $ormResult1, $regionBase);

        return [
            'msg' => '修改地区信息成功',
        ];
    }
}
