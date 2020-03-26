<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 11:37
 */
namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;
use SyTool\Tool;

class PlaceSuggestion extends MapBaseBaiDu
{
    /**
     * 关键词
     * @var string
     */
    private $keyword = '';
    /**
     * 区域
     * @var string
     */
    private $region = '';
    /**
     * 区域限制标识,true:只返回region中指定城市检索结果
     * @var string
     */
    private $cityLimit = '';
    /**
     * 地址
     * @var string
     */
    private $location = '';
    /**
     * 坐标类型
     * @var int
     */
    private $coordType = 0;
    /**
     * 返回的坐标类型
     * @var string
     */
    private $coordTypeReturn = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/v2/suggestion';
        $this->reqData['city_limit'] = 'true';
        $this->reqData['coord_type'] = 3;
        $this->reqData['ret_coordtype'] = 'bd09ll';
        $this->reqData['timestamp'] = Tool::getNowTime();
    }

    public function __clone()
    {
    }

    /**
     * @param string $keyword
     * @throws \SyException\Map\BaiduMapException
     */
    public function setKeyword(string $keyword)
    {
        if (strlen($keyword) > 0) {
            $this->reqData['query'] = $keyword;
        } else {
            throw new BaiduMapException('关键词不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     * @throws \SyException\Map\BaiduMapException
     */
    public function setRegion(string $region)
    {
        if (strlen($region) > 0) {
            $this->reqData['region'] = $region;
        } else {
            throw new BaiduMapException('区域不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $cityLimit
     * @throws \SyException\Map\BaiduMapException
     */
    public function setCityLimit(string $cityLimit)
    {
        if (in_array($cityLimit, ['true', 'false'], true)) {
            $this->reqData['city_limit'] = $cityLimit;
        } else {
            throw new BaiduMapException('区域限制不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
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
     * @param int $coordType
     * @throws \SyException\Map\BaiduMapException
     */
    public function setCoordType(int $coordType)
    {
        if (in_array($coordType, [1, 2, 3, 4,], true)) {
            $this->reqData['coord_type'] = $coordType;
        } else {
            throw new BaiduMapException('坐标类型不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $coordTypeReturn
     * @throws \SyException\Map\BaiduMapException
     */
    public function setCoordTypeReturn(string $coordTypeReturn)
    {
        if (strlen($coordTypeReturn) > 0) {
            $this->reqData['ret_coordtype'] = $coordTypeReturn;
        } else {
            throw new BaiduMapException('返回坐标类型不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['query'])) {
            throw new BaiduMapException('关键词不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        } elseif (!isset($this->reqData['region'])) {
            throw new BaiduMapException('地区不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
