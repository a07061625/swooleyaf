<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/10 0010
 * Time: 16:16
 */
namespace SyMap\Tencent;

use SyConstant\ErrorCode;
use SyException\Map\TencentMapException;
use SyMap\MapBaseTencent;

class PlaceSuggestion extends MapBaseTencent
{
    /**
     * 关键词
     * @var string
     */
    private $keyword = '';
    /**
     * 地区
     * @var string
     */
    private $region = '';
    /**
     * 地区限制标识,0：当前城市无结果时,自动扩大范围到全国匹配 1：固定在当前城市
     * @var int
     */
    private $regionLimit = 0;
    /**
     * 定位坐标
     * @var string
     */
    private $location = '';
    /**
     * 子地点限制标识 0:不返回 1:返回
     * @var int
     */
    private $subLimit = 0;
    /**
     * 检索策略
     * @var int
     */
    private $policy = 0;
    /**
     * 筛选条件
     * @var array
     */
    private $filters = [];
    /**
     * 页码
     * @var int
     */
    private $page = 0;
    /**
     * 每页条数
     * @var int
     */
    private $limit = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUrl = 'https://apis.map.qq.com/ws/place/v1/suggestion';
        $this->reqData['region_fix'] = 0;
        $this->reqData['get_subpois'] = 0;
        $this->reqData['policy'] = 0;
        $this->reqData['page_index'] = 1;
        $this->reqData['page_size'] = 10;
    }

    public function __clone()
    {
    }

    /**
     * @param string $keyword
     * @throws \SyException\Map\TencentMapException
     */
    public function setKeyword(string $keyword)
    {
        if (strlen($keyword) > 0) {
            $this->reqData['keyword'] = $keyword;
        } else {
            throw new TencentMapException('关键词不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $region
     * @throws \SyException\Map\TencentMapException
     */
    public function setRegion(string $region)
    {
        if (strlen($region) > 0) {
            $this->reqData['region'] = $region;
        } else {
            throw new TencentMapException('地区不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $regionLimit
     * @throws \SyException\Map\TencentMapException
     */
    public function setRegionLimit(int $regionLimit)
    {
        if (in_array($regionLimit, [0, 1], true)) {
            $this->reqData['region_fix'] = $regionLimit;
        } else {
            throw new TencentMapException('地区限制不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
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
     * @param int $subLimit
     * @throws \SyException\Map\TencentMapException
     */
    public function setSubLimit(int $subLimit)
    {
        if (in_array($subLimit, [0, 1], true)) {
            $this->reqData['get_subpois'] = $subLimit;
        } else {
            throw new TencentMapException('子地点限制不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $policy
     */
    public function setPolicy(int $policy)
    {
        $this->reqData['policy'] = $policy;
    }

    /**
     * @param array $filters
     */
    public function addFilters(array $filters)
    {
        foreach ($filters as $key => $val) {
            $this->filters[$key] = $val;
        }
    }

    /**
     * @param array $filters
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page)
    {
        $this->reqData['page_index'] = $page > 0 ? $page : 1;
    }

    /**
     * @param int $limit
     * @throws \SyException\Map\TencentMapException
     */
    public function setLimit(int $limit)
    {
        if (($limit > 0) && ($limit <= 20)) {
            $this->reqData['page_size'] = $limit;
        } else {
            throw new TencentMapException('每页条数不合法', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['keyword'])) {
            throw new TencentMapException('关键词不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        } elseif (!isset($this->reqData['region'])) {
            throw new TencentMapException('地区不能为空', ErrorCode::MAP_TENCENT_PARAM_ERROR);
        }

        if (!empty($this->filters)) {
            $filterStr = '';
            foreach ($this->filters as $key => $val) {
                $filterStr .= ',' . $key . '=' . $val;
            }
            $this->reqData['filter'] = substr($filterStr, 1);
        }

        return $this->getContent();
    }
}
