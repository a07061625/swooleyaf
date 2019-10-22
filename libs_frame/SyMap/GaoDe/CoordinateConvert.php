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
 * 坐标转换
 * @package Map\GaoDe
 */
class CoordinateConvert extends MapBaseGaoDe
{
    /**
     * 经纬度坐标
     * @var string
     */
    private $locations = '';
    /**
     * 原坐标系
     * @var string
     */
    private $coordsys = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/assistant/coordinate/convert';
        $this->reqData['coordsys'] = 'autonavi';
    }

    /**
     * @param array $locationList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setLocations(array $locationList)
    {
        $locationNum = count($locationList);
        if ($locationNum == 0) {
            throw new GaoDeMapException('经纬度坐标不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        } elseif ($locationNum > 40) {
            throw new GaoDeMapException('经纬度坐标不能超过40个', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['locations'] = implode('|', $locationList);
    }

    /**
     * @param string $coordSys
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setCoordSys(string $coordSys)
    {
        if (in_array($coordSys, ['gps', 'mapbar', 'baidu', 'autonavi'], true)) {
            $this->reqData['coordsys'] = $coordSys;
        } else {
            throw new GaoDeMapException('原坐标系不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['locations'])) {
            throw new GaoDeMapException('经纬度坐标不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
