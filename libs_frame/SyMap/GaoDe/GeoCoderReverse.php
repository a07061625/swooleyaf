<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 19-2-14
 * Time: 下午1:42
 */
namespace SyMap\GaoDe;

use SyConstant\ErrorCode;
use SyException\Map\GaoDeMapException;
use SyMap\MapBaseGaoDe;

/**
 * 逆地理编码
 * @package Map\GaoDe
 */
class GeoCoderReverse extends MapBaseGaoDe
{
    /**
     * 经纬度坐标
     * @var string
     */
    private $location = '';
    /**
     * POI类型
     * @var string
     */
    private $poitype = '';
    /**
     * 搜索半径,单位:米
     * @var int
     */
    private $radius = 0;
    /**
     * 返回结果标识
     * @var string
     */
    private $extensions = '';
    /**
     * 批量查询标识
     * @var string
     */
    private $batch = '';
    /**
     * 道路等级 0:显示所有道路 1:仅输出主干道路数据
     * @var int
     */
    private $roadlevel = 0;
    /**
     * POI返回排序 0:不干扰 1:居家相关内容优先返回 2:公司相关内容优先返回
     * @var int
     */
    private $homeorcorp = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/geocode/regeo';
        $this->reqData['radius'] = 1000;
        $this->reqData['extensions'] = 'base';
        $this->reqData['batch'] = 'false';
        $this->reqData['roadlevel'] = 0;
        $this->reqData['homeorcorp'] = 0;
    }

    /**
     * @param array $locationList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setLocation(array $locationList)
    {
        $locationNum = count($locationList);
        if ($locationNum == 0) {
            throw new GaoDeMapException('经纬度坐标不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        } elseif ($locationNum > 20) {
            throw new GaoDeMapException('经纬度坐标不能超过20个', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['location'] = implode('|', $locationList);
    }

    /**
     * @param array $poiTypeList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setPoiType(array $poiTypeList)
    {
        if (empty($poiTypeList)) {
            throw new GaoDeMapException('POI类型不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['poitype'] = implode('|', $poiTypeList);
    }

    /**
     * @param int $radius
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setRadius(int $radius)
    {
        if (($radius > 0) && ($radius <= 3000)) {
            $this->reqData['radius'] = $radius;
        } else {
            throw new GaoDeMapException('搜索半径不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param string $extensions
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setExtensions(string $extensions)
    {
        if (in_array($extensions, ['base', 'all'], true)) {
            $this->reqData['extensions'] = $extensions;
        } else {
            throw new GaoDeMapException('返回结果标识不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param string $batch
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setBatch(string $batch)
    {
        if (in_array($batch, ['true', 'false'], true)) {
            $this->reqData['batch'] = $batch;
        } else {
            throw new GaoDeMapException('批量查询标识不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param int $roadLevel
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setRoadLevel(int $roadLevel)
    {
        if (in_array($roadLevel, [0, 1], true)) {
            $this->reqData['roadlevel'] = $roadLevel;
        } else {
            throw new GaoDeMapException('道路等级不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param int $homeOrCorp
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setHomeOrCorp(int $homeOrCorp)
    {
        if (in_array($homeOrCorp, [0, 1, 2], true)) {
            $this->reqData['homeorcorp'] = $homeOrCorp;
        } else {
            throw new GaoDeMapException('POI返回排序不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['location'])) {
            throw new GaoDeMapException('经纬度坐标不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
