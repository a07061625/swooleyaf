<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 18-9-9
 * Time: 下午3:14
 */
namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;

class GeoCoder extends MapBaseBaiDu
{
    /**
     * 地址
     * @var string
     */
    private $address = '';
    /**
     * 城市名
     * @var string
     */
    private $cityName = '';
    /**
     * 返回的坐标类型
     * @var string
     */
    private $coordTypeReturn = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/geocoder/v2/';
    }

    public function __clone()
    {
    }

    /**
     * @param string $address
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAddress(string $address)
    {
        if (strlen($address) > 0) {
            $this->reqData['address'] = mb_substr($address, 0, 42);
        } else {
            throw new BaiduMapException('地址不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $cityName
     */
    public function setCityName(string $cityName)
    {
        $this->reqData['city'] = trim($cityName);
    }

    /**
     * @param string $coordTypeReturn
     */
    public function setCoordTypeReturn(string $coordTypeReturn)
    {
        $this->reqData['ret_coordtype'] = trim($coordTypeReturn);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['address'])) {
            throw new BaiduMapException('地址不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
