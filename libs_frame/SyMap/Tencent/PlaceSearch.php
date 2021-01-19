<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 16:15
 */

namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class PlaceSearch extends MapBaseTencent
{
    const REGION_AUTO_EXTENT_NO = 0;
    const REGION_AUTO_EXTENT_YES = 1;
    const PLACE_SEARCH_TYPE_REGION = 'region'; //区域搜索类型-地区
    const PLACE_SEARCH_TYPE_NEARBY = 'nearby'; //区域搜索类型-圆形区域
    const PLACE_SEARCH_TYPE_RECTANGLE = 'rectangle'; //区域搜索类型-矩形区域

    /**
     * 搜索关键字
     *
     * @var string
     */
    private $keyword = '';
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
     * 筛选条件
     *
     * @var string
     */
    private $filter = '';
    /**
     * 排序方式
     *
     * @var string
     */
    private $orderBy = '';
    /**
     * 搜索类型
     *
     * @var string
     */
    private $searchType = '';
    /**
     * 区域搜索城市名称
     *
     * @var string
     */
    private $areaRegionCityName = '';
    /**
     * 区域搜索是否自动扩大范围 0:仅在当前城市搜索 1:若当前城市搜索无结果,则自动扩大范围
     *
     * @var int
     */
    private $areaRegionAutoExtend = 1;
    /**
     * 区域搜索经度
     *
     * @var string
     */
    private $areaRegionLng = '';
    /**
     * 区域搜索纬度
     *
     * @var string
     */
    private $areaRegionLat = '';
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
        $this->serviceUrl = 'https://apis.map.qq.com/ws/place/v1/search';
        $this->reqData['page_size'] = 10;
        $this->reqData['page_index'] = 1;
        $this->areaRegionAutoExtend = self::REGION_AUTO_EXTENT_YES;
    }

    public function __clone()
    {
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setKeyword(string $keyword)
    {
        $trueWord = trim($keyword);
        if (\strlen($trueWord) > 0) {
            $this->reqData['keyword'] = $trueWord;
        } else {
            throw new TencentMapException('搜索关键字不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize > 0) && ($pageSize <= 20)) {
            $this->reqData['page_size'] = $pageSize;
        } else {
            throw new TencentMapException('每页条目数只能在1-20之间', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setPageIndex(int $pageIndex)
    {
        if ($pageIndex > 0) {
            $this->reqData['page_index'] = $pageIndex;
        } else {
            throw new TencentMapException('页数必须大于0', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setFilter(string $filter)
    {
        $trueFilter = trim($filter);
        if (\strlen($trueFilter) > 0) {
            $this->reqData['filter'] = $trueFilter;
        } else {
            throw new TencentMapException('筛选条件不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * 设置排序
     *
     * @param string $field 排序字段
     * @param bool   $isAsc 是否为升序,true:升序 false:降序
     *
     * @throws \SyException\Map\TencentMapException
     */
    public function setOrderBy(string $field, bool $isAsc = true)
    {
        $trueField = trim($field);
        if (\strlen($trueField) > 0) {
            $this->reqData['orderby'] = $isAsc ? $trueField . ' asc' : $trueField . 'desc';
        } else {
            throw new TencentMapException('排序字段不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaRegionCityName(string $areaRegionCityName)
    {
        $cityName = trim($areaRegionCityName);
        if (\strlen($cityName) > 0) {
            $this->areaRegionCityName = $cityName;
        } else {
            throw new TencentMapException('区域搜索城市名称不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaRegionAutoExtend(int $areaRegionAutoExtend)
    {
        if (\in_array($areaRegionAutoExtend, [self::REGION_AUTO_EXTENT_NO, self::REGION_AUTO_EXTENT_YES], true)) {
            $this->areaRegionAutoExtend = $areaRegionAutoExtend;
        } else {
            throw new TencentMapException('区域搜索自动扩大标识不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $lng 经度
     * @param string $lat 纬度
     *
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaRegionLngAndLat(string $lng, string $lat)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng)) {
            throw new TencentMapException('区域搜索经度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat)) {
            throw new TencentMapException('区域搜索纬度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        $this->areaRegionLng = $lng;
        $this->areaRegionLat = $lat;
    }

    /**
     * @param string $lng 经度
     * @param string $lat 纬度
     *
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaNearbyLngAndLat(string $lng, string $lat)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng)) {
            throw new TencentMapException('圆形范围搜索中心点经度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat)) {
            throw new TencentMapException('圆形范围搜索中心点纬度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        $this->areaNearbyLng = $lng;
        $this->areaNearbyLat = $lat;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaNearbyRadius(int $areaNearbyRadius)
    {
        if ($areaNearbyRadius > 0) {
            $this->areaNearbyRadius = $areaNearbyRadius;
        } else {
            throw new TencentMapException('圆形范围搜索半径必须大于0', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $lng1 西南角经度
     * @param string $lat1 西南角纬度
     * @param string $lng2 东北角经度
     * @param string $lat2 东北角纬度
     *
     * @throws \SyException\Map\TencentMapException
     */
    public function setAreaRectangLngAndLat(string $lng1, string $lat1, string $lng2, string $lat2)
    {
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng1)) {
            throw new TencentMapException('矩形范围搜索西南角经度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat1)) {
            throw new TencentMapException('矩形范围搜索西南角纬度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LNG, $lng2)) {
            throw new TencentMapException('矩形范围搜索东北角经度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == preg_match(ProjectBase::REGEX_LOCATION_LAT, $lat2)) {
            throw new TencentMapException('矩形范围搜索东北角纬度不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if ((float)$lat1 >= (float)$lat2) {
            throw new TencentMapException('矩形范围搜索东北角纬度必须大于西南角纬度', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        $this->areaRectangleLng1 = $lng1;
        $this->areaRectangleLat1 = $lat1;
        $this->areaRectangleLng2 = $lng2;
        $this->areaRectangleLat2 = $lat2;
    }

    /**
     * @throws \SyException\Map\TencentMapException
     */
    public function setSearchType(string $searchType)
    {
        if (\in_array($searchType, [self::PLACE_SEARCH_TYPE_NEARBY, self::PLACE_SEARCH_TYPE_NEARBY, self::PLACE_SEARCH_TYPE_NEARBY], true)) {
            $this->searchType = $searchType;
        } else {
            throw new TencentMapException('区域搜索类型不支持', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['keyword'])) {
            throw new TencentMapException('搜索关键字不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
        if (0 == \strlen($this->searchType)) {
            throw new TencentMapException('区域搜索类型不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        switch ($this->searchType) {
            case self::PLACE_SEARCH_TYPE_REGION:
                if (0 == \strlen($this->areaRegionCityName)) {
                    throw new TencentMapException('区域名称不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
                }
                if ((\strlen($this->areaRegionLng) > 0) && (\strlen($this->areaRegionLat) > 0)) {
                    $this->reqData['boundary'] = 'region(' . $this->areaRegionCityName . ',' . $this->areaRegionAutoExtend . ',' . $this->areaRegionLat . ',' . $this->areaRegionLng . ')';
                } else {
                    $this->reqData['boundary'] = 'region(' . $this->areaRegionCityName . ',' . $this->areaRegionAutoExtend . ')';
                }

                break;
            case self::PLACE_SEARCH_TYPE_NEARBY:
                if ((0 == \strlen($this->areaNearbyLat)) || (0 == \strlen($this->areaNearbyLng))) {
                    throw new TencentMapException('中心点经度和纬度都不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
                }
                if ($this->areaNearbyRadius <= 0) {
                    throw new TencentMapException('搜索半径必须大于0', ErrorCode::MAP_TENCENT_PARAM_ERROR);
                }
                $this->reqData['boundary'] = 'nearby(' . $this->areaNearbyLat . ',' . $this->areaNearbyLng . ',' . $this->areaNearbyRadius . ')';

                break;
            case self::PLACE_SEARCH_TYPE_RECTANGLE:
                if (0 == \strlen($this->areaRectangleLng1)) {
                    throw new TencentMapException('矩形范围搜索经度和纬度都不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
                }
                $this->reqData['boundary'] = 'rectangle(' . $this->areaRectangleLat1 . ',' . $this->areaRectangleLng1 . ',' . $this->areaRectangleLat2 . ',' . $this->areaRectangleLng2 . ')';

                break;
        }

        return $this->getContent();
    }
}
