<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 11:34
 */

namespace SyMap\BaiDu;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\BaiduMapException;
use SyMap\MapBaseBaiDu;
use SyTool\Tool;

class PlaceSearch extends MapBaseBaiDu
{
    const LL_COORDINATE_TYPE_WGS = 1; //经纬度坐标类型-GPS
    const LL_COORDINATE_TYPE_GCJ = 2; //经纬度坐标类型-国测局
    const LL_COORDINATE_TYPE_BD = 3; //经纬度坐标类型-百度
    const LL_COORDINATE_TYPE_BD_MC = 4; //经纬度坐标类型-百度墨卡托米制
    const SCOPE_BASE = 1; //结果详细程度-基本信息
    const SCOPE_DETAIL = 2; //结果详细程度-POI详细信息
    const PLACE_SEARCH_REGION_CITY_LIMIT_NO = 'false'; //区域搜索城市限定标识-不限定城市
    const PLACE_SEARCH_REGION_CITY_LIMIT_YES = 'true'; //区域搜索城市限定标识-限定城市
    const PLACE_SEARCH_TYPE_REGION = 'region'; //区域搜索类型-地区
    const PLACE_SEARCH_TYPE_NEARBY = 'nearby'; //区域搜索类型-圆形区域
    const PLACE_SEARCH_TYPE_RECTANGLE = 'rectangle'; //区域搜索类型-矩形区域

    /**
     * 检索关键字数组,最多支持10个关键字检索
     *
     * @var array
     */
    private $keywords = [];
    /**
     * 标签数组
     *
     * @var array
     */
    private $tags = [];
    /**
     * 结果详细程度
     *
     * @var int
     */
    private $scope = 0;
    /**
     * 过滤条件
     *
     * @var string
     */
    private $filter = '';
    /**
     * 坐标类型
     *
     * @var int
     */
    private $coordinateType = 0;
    /**
     * 每页条目数,最大限制为20条
     *
     * @var int
     */
    private $pageSize = 0;
    /**
     * 页数,默认第1页
     *
     * @var int
     */
    private $pageIndex = 0;
    /**
     * 搜索类型
     *
     * @var string
     */
    private $searchType = '';
    /**
     * 区域搜索地区名称,市级以上行政区域
     *
     * @var string
     */
    private $areaRegionName = '';
    /**
     * 区域搜索是否只返回指定region（城市）内的POI
     *
     * @var string
     */
    private $areaRegionCityLimit = '';
    /**
     * 圆形范围搜索中心点经度
     *
     * @var string
     */
    private $areaNearbyLng = '';
    /**
     * 圆形范围搜索中心点纬度
     *
     * @var string
     */
    private $areaNearbyLat = '';
    /**
     * 圆形范围搜索半径,单位为米
     *
     * @var int
     */
    private $areaNearbyRadius = 0;
    /**
     * 矩形范围搜索西南角经度
     *
     * @var string
     */
    private $areaRectangleLng1 = '';
    /**
     * 矩形范围搜索西南角纬度
     *
     * @var string
     */
    private $areaRectangleLat1 = '';
    /**
     * 矩形范围搜索东北角经度
     *
     * @var string
     */
    private $areaRectangleLng2 = '';
    /**
     * 矩形范围搜索东北角纬度
     *
     * @var string
     */
    private $areaRectangleLat2 = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/v2/search';
        $this->reqData['scope'] = self::SCOPE_BASE;
        $this->reqData['coord_type'] = self::LL_COORDINATE_TYPE_BD;
        $this->reqData['page_size'] = 10;
        $this->reqData['page_num'] = 0;
        $this->reqData['timestamp'] = Tool::getNowTime();
        $this->areaRegionCityLimit = self::PLACE_SEARCH_REGION_CITY_LIMIT_NO;
    }

    public function __clone()
    {
    }

    /**
     * 添加检索关键字
     *
     * @param string $keyword 检索关键字
     *
     * @throws \SyException\Map\BaiduMapException
     */
    public function addKeyword(string $keyword)
    {
        if (\count($this->keywords) >= 10) {
            throw new BaiduMapException('检索关键字数量超过最大限制', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $str1 = preg_replace([
            '/[\-\_\.\~\!\*\'\(\)\;\:\@\&\=\+\$\,\/\?\%\#\[\]]+/',
            '/\s+/',
        ], [
            '',
            ' ',
        ], $keyword);
        $str2 = trim($str1);
        if (0 == \strlen($str2)) {
            throw new BaiduMapException('检索关键字不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        if (!\in_array($str2, $this->keywords, true)) {
            $this->keywords[] = $str2;
        }
    }

    /**
     * 添加标签
     *
     * @param string $tag 标签
     *
     * @throws \SyException\Map\BaiduMapException
     */
    public function addTag(string $tag)
    {
        $str1 = preg_replace([
            '/\,+/',
            '/\s+/',
        ], [
            '',
            ' ',
        ], $tag);
        $str2 = trim($str1);
        if (0 == \strlen($str2)) {
            throw new BaiduMapException('标签不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->tags[$str2] = 1;
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setScope(int $scope)
    {
        if (\in_array($scope, [self::SCOPE_BASE, self::SCOPE_DETAIL], true)) {
            $this->reqData['scope'] = $scope;
        } else {
            throw new BaiduMapException('结果详细程度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setFilter(string $filter)
    {
        $trueFilter = trim($filter);
        if (\strlen($trueFilter) > 0) {
            $this->reqData['filter'] = $trueFilter;
        } else {
            throw new BaiduMapException('过滤条件不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setCoordinateType(int $coordinateType)
    {
        if (\in_array($coordinateType, [self::LL_COORDINATE_TYPE_WGS, self::LL_COORDINATE_TYPE_GCJ, self::LL_COORDINATE_TYPE_BD, self::LL_COORDINATE_TYPE_BD_MC], true)) {
            $this->reqData['coord_type'] = $coordinateType;
        } else {
            throw new BaiduMapException('坐标类型不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 20)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new BaiduMapException('每页条目数只能在1-20之间', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setPageIndex(int $pageIndex)
    {
        if ($pageIndex > 0) {
            $this->reqData['page_num'] = $pageIndex;
        } else {
            throw new BaiduMapException('页数必须大于0', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAreaRegionName(string $areaRegionName)
    {
        $str1 = preg_replace([
            '/[\-\_\.\~\!\*\'\(\)\;\:\@\&\=\+\$\,\/\?\%\#\[\]]+/',
            '/\s+/',
        ], [
            '',
            ' ',
        ], $areaRegionName);
        $str2 = trim($str1);
        if (0 == \strlen($str2)) {
            throw new BaiduMapException('区域名称不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->areaRegionName = $str2;
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAreaRegionCityLimit(string $areaRegionCityLimit)
    {
        if (\in_array($areaRegionCityLimit, [self::PLACE_SEARCH_REGION_CITY_LIMIT_NO, self::PLACE_SEARCH_REGION_CITY_LIMIT_YES], true)) {
            $this->areaRegionCityLimit = $areaRegionCityLimit;
        } else {
            throw new BaiduMapException('城市限制标识不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $lng 经度
     * @param string $lat 纬度
     *
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAreaNearbyLngAndLat(string $lng, string $lat)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng)) {
            throw new BaiduMapException('圆形范围搜索中心点经度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat)) {
            throw new BaiduMapException('圆形范围搜索中心点纬度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->areaNearbyLng = $lng;
        $this->areaNearbyLat = $lat;
    }

    /**
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAreaNearbyRadius(int $areaNearbyRadius)
    {
        if ($areaNearbyRadius > 0) {
            $this->areaNearbyRadius = $areaNearbyRadius;
        } else {
            throw new BaiduMapException('圆形范围搜索半径必须大于0', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    /**
     * @param string $lng1 西南角经度
     * @param string $lat1 西南角纬度
     * @param string $lng2 东北角经度
     * @param string $lat2 东北角纬度
     *
     * @throws \SyException\Map\BaiduMapException
     */
    public function setAreaRectangLngAndLat(string $lng1, string $lat1, string $lng2, string $lat2)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng1)) {
            throw new BaiduMapException('矩形范围搜索西南角经度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat1)) {
            throw new BaiduMapException('矩形范围搜索西南角纬度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng2)) {
            throw new BaiduMapException('矩形范围搜索东北角经度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat2)) {
            throw new BaiduMapException('矩形范围搜索东北角纬度不合法', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if ((float)$lat1 >= (float)$lat2) {
            throw new BaiduMapException('矩形范围搜索东北角纬度必须大于西南角纬度', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        $this->areaRectangleLng1 = $lng1;
        $this->areaRectangleLat1 = $lat1;
        $this->areaRectangleLng2 = $lng2;
        $this->areaRectangleLat2 = $lat2;
    }

    /**
     * @param string $searchType 搜索类型 region:地区搜索 nearby:圆形区域搜索 rectangle:矩形区域搜索
     *
     * @throws \SyException\Map\BaiduMapException
     */
    public function setSearchType(string $searchType)
    {
        if (\in_array($searchType, [self::PLACE_SEARCH_TYPE_REGION, self::PLACE_SEARCH_TYPE_NEARBY, self::PLACE_SEARCH_TYPE_RECTANGLE], true)) {
            $this->searchType = $searchType;
        } else {
            throw new BaiduMapException('区域搜索类型不支持', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (empty($this->keywords)) {
            throw new BaiduMapException('检索关键字不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (0 == \strlen($this->searchType)) {
            throw new BaiduMapException('区域搜索类型不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        switch ($this->searchType) {
            case self::PLACE_SEARCH_TYPE_REGION:
                if (0 == \strlen($this->areaRegionName)) {
                    throw new BaiduMapException('区域名称不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }
                $this->reqData['region'] = $this->areaRegionName;
                $this->reqData['city_limit'] = $this->areaRegionCityLimit;

                break;
            case self::PLACE_SEARCH_TYPE_NEARBY:
                if ((0 == \strlen($this->areaNearbyLat)) || (0 == \strlen($this->areaNearbyLng))) {
                    throw new BaiduMapException('中心点经度和纬度都不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }
                if ($this->areaNearbyRadius <= 0) {
                    throw new BaiduMapException('搜索半径必须大于0', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }
                $this->reqData['location'] = $this->areaNearbyLat . ',' . $this->areaNearbyLng;
                $this->reqData['radius'] = $this->areaNearbyRadius;

                break;
            case self::PLACE_SEARCH_TYPE_RECTANGLE:
                if (0 == \strlen($this->areaRectangleLng1)) {
                    throw new BaiduMapException('矩形范围搜索经度和纬度都不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
                }
                $this->reqData['bounds'] = $this->areaRectangleLat1 . ',' . $this->areaRectangleLng1 . ',' . $this->areaRectangleLat2 . ',' . $this->areaRectangleLng2;

                break;
        }
        $this->reqData['query'] = implode(' ', $this->keywords);

        if (!empty($this->tags)) {
            $this->reqData['tag'] = implode(',', array_keys($this->tags));
        }

        return $this->getContent();
    }
}
