<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 14:08
 */
namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class GeoCoder extends MapBaseTencent
{
    /**
     * 地址
     * @var string
     */
    private $address = '';
    /**
     * 地区
     * @var string
     */
    private $region = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/geocoder/v1/';
        $this->rspDataKey = 'result';
    }

    public function __clone()
    {
    }

    /**
     * @param string $address
     * @throws \SyException\Map\TencentMapException
     */
    public function setAddress(string $address)
    {
        if (strlen($address) > 0) {
            $this->reqData['address'] = $address;
        } else {
            throw new TencentMapException('地址不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->reqData['region'] = $region;
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['address'])) {
            throw new TencentMapException('地址不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
