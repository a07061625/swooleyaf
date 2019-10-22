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
 * 输入提示
 * @package Map\GaoDe
 */
class AssistantInputTips extends MapBaseGaoDe
{
    /**
     * 关键字
     * @var string
     */
    private $keywords = '';
    /**
     * POI类型
     * @var string
     */
    private $type = '';
    /**
     * 坐标
     * @var string
     */
    private $location = '';
    /**
     * 城市
     * @var string
     */
    private $city = '';
    /**
     * 指定城市标识
     * @var string
     */
    private $citylimit = '';
    /**
     * 返回数据类型 all:所有数据类型 poi:POI数据 bus:公交站点数据 busline:公交线路数据
     * @var string
     */
    private $datatype = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/assistant/inputtips';
        $this->reqData['citylimit'] = 'false';
        $this->reqData['datatype'] = 'all';
    }

    /**
     * @param string $keyword
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setKeywords(string $keyword)
    {
        if (strlen($keyword) > 0) {
            $this->reqData['keywords'] = $keyword;
        } else {
            throw new GaoDeMapException('关键字不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param array $typeList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setType(array $typeList)
    {
        $types = [];
        foreach ($typeList as $eType) {
            if (ctype_digit($eType) && (strlen($eType) == 6)) {
                $types[$eType] = 1;
            }
        }

        if (empty($types)) {
            throw new GaoDeMapException('POI类型不能为空', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['type'] = implode('|', array_keys($types));
    }

    /**
     * @param double $lat
     * @param double $lng
     */
    public function setLocation($lat, $lng)
    {
        $this->reqData['location'] = $lng . ',' . $lat;
    }

    /**
     * @param string $city
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setCity(string $city)
    {
        if (ctype_alnum($city)) {
            $this->reqData['city'] = $city;
        } else {
            throw new GaoDeMapException('城市不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param string $cityLimit
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setCityLimit(string $cityLimit)
    {
        if (in_array($cityLimit, ['true', 'false'], true)) {
            $this->reqData['citylimit'] = $cityLimit;
        } else {
            throw new GaoDeMapException('指定城市标识不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param array $dataTypeList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setDataType(array $dataTypeList)
    {
        $dataTypes = [];
        foreach ($dataTypeList as $eDataType) {
            if (is_string($eDataType) && in_array($eDataType, ['all', 'poi', 'bus', 'busline'], true)) {
                $dataTypes[$eDataType] = 1;
            }
        }
        if (empty($dataTypes)) {
            throw new GaoDeMapException('返回数据类型不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['datatype'] = implode('|', array_keys($dataTypes));
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['keywords'])) {
            throw new GaoDeMapException('关键字不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
