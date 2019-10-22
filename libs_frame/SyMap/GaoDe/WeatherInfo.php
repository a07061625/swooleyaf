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
 * 天气查询
 * @package Map\GaoDe
 */
class WeatherInfo extends MapBaseGaoDe
{
    /**
     * 城市编码
     * @var string
     */
    private $city = '';
    /**
     * 气象类型 base:实况天气 all:预报天气
     * @var string
     */
    private $extensions = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/weather/weatherInfo';
        $this->reqData['extensions'] = 'base';
    }

    /**
     * @param string $city
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setCity(string $city)
    {
        if (ctype_digit($city) && (strlen($city) == 6)) {
            $this->reqData['city'] = $city;
        } else {
            throw new GaoDeMapException('城市编码不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
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
            throw new GaoDeMapException('气象类型不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['city'])) {
            throw new GaoDeMapException('城市编码不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
