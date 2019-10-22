<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 15:40
 */
namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class GeoCoderReverse extends MapBaseTencent
{
    /**
     * 坐标
     * @var string
     */
    private $location = '';
    /**
     * poi状态 0:不返回 1:返回
     * @var int
     */
    private $poiStatus = 0;
    /**
     * poi选项列表
     * @var array
     */
    private $poiOptions = [];

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/geocoder/v1/';
        $this->rspDataKey = 'result';
        $this->reqData['get_poi'] = 0;
    }

    public function __clone()
    {
    }

    /**
     * @param double $lat
     * @param double $lng
     */
    public function setLocation($lat, $lng)
    {
        $this->reqData['location'] = $lat . ',' . $lng;
    }

    /**
     * @param int $poiStatus
     * @throws \SyException\Map\TencentMapException
     */
    public function setPoiStatus(int $poiStatus)
    {
        if (in_array($poiStatus, [0, 1], true)) {
            $this->reqData['get_poi'] = $poiStatus;
        } else {
            throw new TencentMapException('poi状态不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param array $poiOptions
     */
    public function addPoiOptions(array $poiOptions)
    {
        foreach ($poiOptions as $poiKey => $poiVal) {
            $this->poiOptions[$poiKey] = $poiVal;
        }
    }

    /**
     * @param array $poiOptions
     */
    public function setPoiOptions(array $poiOptions)
    {
        $this->poiOptions = $poiOptions;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['location'])) {
            throw new TencentMapException('坐标不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        if (!empty($this->poiOptions)) {
            $optionStr = '';
            foreach ($this->poiOptions as $optKey => $optVal) {
                $optionStr = ';' . $optKey . '=' . $optVal;
            }
            $this->reqData['poi_options'] = substr($optionStr, 1);
        }

        return $this->getContent();
    }
}
