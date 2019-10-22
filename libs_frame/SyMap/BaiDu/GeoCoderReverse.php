<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 9:20
 */
namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;

class GeoCoderReverse extends MapBaseBaiDu
{
    /**
     * 坐标地址
     * @var string
     */
    private $location = '';
    /**
     * 坐标类型
     * @var string
     */
    private $coordType = '';
    /**
     * 返回的坐标类型
     * @var string
     */
    private $coordTypeReturn = '';
    /**
     * poi召回状态,0为不召回,1为召回
     * @var int
     */
    private $poiStatus = 0;
    /**
     * poi召回半径,单位为米
     * @var int
     */
    private $poiRadius = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/geocoder/v2/';
    }

    public function __clone()
    {
    }

    /**
     * @param double $lat 纬度
     * @param double $lng 经度
     */
    public function setLocation($lat, $lng)
    {
        $this->reqData['location'] = $lat . ',' . $lng;
    }

    /**
     * @param string $coordType
     */
    public function setCoordType(string $coordType)
    {
        $this->reqData['coordtype'] = $coordType;
        $this->reqData['ret_coordtype'] = $coordType;
    }

    /**
     * @param string $coordTypeReturn
     */
    public function setCoordTypeReturn(string $coordTypeReturn)
    {
        $this->reqData['ret_coordtype'] = $coordTypeReturn;
    }

    /**
     * @param int $poiStatus
     * @throws \SyException\Map\BaiduMapException
     */
    public function setPoiStatusAndRadius(int $poiStatus, int $poiRadius)
    {
        if (!in_array($poiStatus, [0, 1], true)) {
            throw new BaiduMapException('poi召回状态不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        } elseif (($poiRadius < 0) || ($poiRadius > 1000)) {
            throw new BaiduMapException('poi召回半径不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->reqData['pois'] = $poiStatus;
        $this->reqData['radius'] = $poiRadius;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['location'])) {
            throw new BaiduMapException('坐标地址不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
