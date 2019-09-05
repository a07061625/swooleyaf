<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 9:47
 */
namespace Map\BaiDu;

use SyConstant\ErrorCode;
use SyException\Map\BaiduMapException;
use Map\MapBaseBaiDu;

class CoordinateTranslate extends MapBaseBaiDu
{
    const COORDINATE_TYPE_GPS = 1; //坐标类型-GPS角度
    const COORDINATE_TYPE_GPS_MS = 2; //坐标类型-GPS米制
    const COORDINATE_TYPE_GOOGLE = 3; //坐标类型-google
    const COORDINATE_TYPE_GOOGLE_MS = 4; //坐标类型-google米制
    const COORDINATE_TYPE_BD = 5; //坐标类型-百度
    const COORDINATE_TYPE_BD_MS = 6; //坐标类型-百度米制
    const COORDINATE_TYPE_MAPBAR = 7; //坐标类型-mapbar
    const COORDINATE_TYPE_51 = 8; //坐标类型-51

    private $totalCoordinateTypes = [
        self::COORDINATE_TYPE_GPS => 1,
        self::COORDINATE_TYPE_GPS_MS => 1,
        self::COORDINATE_TYPE_GOOGLE => 1,
        self::COORDINATE_TYPE_GOOGLE_MS => 1,
        self::COORDINATE_TYPE_BD => 1,
        self::COORDINATE_TYPE_BD_MS => 1,
        self::COORDINATE_TYPE_MAPBAR => 1,
        self::COORDINATE_TYPE_51 => 1,
    ];

    /**
     * 源坐标数组
     * @var array
     */
    private $coords = [];
    /**
     * 源坐标类型
     * @var int
     */
    private $fromType = 0;
    /**
     * 目的坐标类型
     * @var int
     */
    private $toType = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/geoconv/v1/';
        $this->rspDataKey = 'result';
        $this->reqData['from'] = self::COORDINATE_TYPE_GPS;
        $this->reqData['to'] = self::COORDINATE_TYPE_BD;
    }

    public function __clone()
    {
    }

    /**
     * 添加坐标
     * @param string $lng
     * @param string $lat
     * @throws \SyException\Map\BaiduMapException
     */
    public function addCoordinate(string $lng, string $lat)
    {
        if (count($this->coords) >= 100) {
            throw new BaiduMapException('源坐标数量超过限制', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (preg_match('/^[-]?(\d(\.\d+)?|[1-9]\d(\.\d+)?|1[0-7]\d(\.\d+)?|180)$/', $lng) == 0) {
            throw new BaiduMapException('源坐标经度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (preg_match('/^[\-]?(\d(\.\d+)?|[1-8]\d(\.\d+)?|90)$/', $lat) == 0) {
            throw new BaiduMapException('源坐标纬度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $key = $lng . ',' . $lat;
        $this->coords[$key] = 1;
    }

    /**
     * @param int $fromType
     * @throws \SyException\Map\BaiduMapException
     */
    public function setFromType(int $fromType)
    {
        if (isset($this->totalCoordinateTypes[$fromType])) {
            $this->reqData['from'] = $fromType;
        } else {
            throw new BaiduMapException('源坐标类型不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param int $toType
     * @throws \SyException\Map\BaiduMapException
     */
    public function setToType(int $toType)
    {
        if (in_array($toType, [self::COORDINATE_TYPE_BD, self::COORDINATE_TYPE_BD_MS], true)) {
            $this->reqData['to'] = $toType;
        } else {
            throw new BaiduMapException('目的坐标类型不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (empty($this->coords)) {
            throw new BaiduMapException('源坐标不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->reqData['coords'] = implode(';', array_keys($this->coords));
        return $this->getContent();
    }
}
