<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 15:58
 */

namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class CoordinateTranslate extends MapBaseTencent
{
    const COORDINATE_TYPE_GPS = 1; //坐标类型-GPS
    const COORDINATE_TYPE_SOGOU = 2; //坐标类型-搜狗
    const COORDINATE_TYPE_BD = 3; //坐标类型-百度
    const COORDINATE_TYPE_MAPBAR = 4; //坐标类型-mapbar
    const COORDINATE_TYPE_GOOGLE = 5; //坐标类型-google
    const COORDINATE_TYPE_SOGOU_MC = 6; //坐标类型-搜狗墨卡托

    private $totalCoordinateTypes = [
        self::COORDINATE_TYPE_GPS => 1,
        self::COORDINATE_TYPE_SOGOU => 1,
        self::COORDINATE_TYPE_BD => 1,
        self::COORDINATE_TYPE_MAPBAR => 1,
        self::COORDINATE_TYPE_GOOGLE => 1,
        self::COORDINATE_TYPE_SOGOU_MC => 1,
    ];

    /**
     * 源坐标数组
     *
     * @var array
     */
    private $coords = [];
    /**
     * 源坐标类型
     *
     * @var int
     */
    private $fromType = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/coord/v1/translate';
        $this->rspDataKey = 'locations';
        $this->reqData['type'] = self::COORDINATE_TYPE_GOOGLE;
    }

    public function __clone()
    {
    }

    /**
     * 添加坐标
     *
     * @throws \SyException\Map\TencentMapException
     */
    public function addCoordinate(string $lng, string $lat)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng)) {
            throw new TencentMapException('源坐标经度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat)) {
            throw new TencentMapException('源坐标纬度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        $key = $lat . ',' . $lng;
        $this->coords[$key] = 1;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setFromType(int $fromType)
    {
        if (isset($this->totalCoordinateTypes[$fromType])) {
            $this->reqData['type'] = $fromType;
        } else {
            throw new TencentMapException('源坐标类型不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (empty($this->coords)) {
            throw new TencentMapException('源坐标不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        $this->reqData['locations'] = implode(';', array_keys($this->coords));

        return $this->getContent();
    }
}
