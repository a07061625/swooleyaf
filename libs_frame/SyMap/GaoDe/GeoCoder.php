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
 * 地理编码
 * @package Map\GaoDe
 */
class GeoCoder extends MapBaseGaoDe
{
    /**
     * 地址
     * @var string
     */
    private $address = '';
    /**
     * 城市
     * @var string
     */
    private $city = '';
    /**
     * 批量查询标识
     * @var string
     */
    private $batch = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/geocode/geo';
        $this->reqData['batch'] = 'false';
    }

    /**
     * @param array $addressList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setAddress(array $addressList)
    {
        $addressNum = count($addressList);
        if ($addressNum == 0) {
            throw new GaoDeMapException('地址不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        } elseif ($addressNum > 10) {
            throw new GaoDeMapException('地址不能超过10个', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['address'] = implode('|', $addressList);
    }

    /**
     * @param string $city
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setCity(string $city)
    {
        if (strlen($city) > 0) {
            $this->reqData['city'] = $city;
        } else {
            throw new GaoDeMapException('城市不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['address'])) {
            throw new GaoDeMapException('地址不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
