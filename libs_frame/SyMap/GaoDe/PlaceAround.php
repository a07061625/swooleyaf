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
 * 周边搜索
 * @package Map\GaoDe
 */
class PlaceAround extends MapBaseGaoDe
{
    /**
     * 中心点坐标
     * @var string
     */
    private $location = '';
    /**
     * 关键字
     * @var string
     */
    private $keywords = '';
    /**
     * POI类型
     * @var string
     */
    private $types = '';
    /**
     * 城市
     * @var string
     */
    private $city = '';
    /**
     * 搜索半径,单位:米
     * @var int
     */
    private $radius = 0;
    /**
     * 排序规则 distance:距离排序 weight:综合排序
     * @var string
     */
    private $sortrule = '';
    /**
     * 每页记录数
     * @var int
     */
    private $offset = 0;
    /**
     * 当前页数
     * @var int
     */
    private $page = 0;
    /**
     * 返回结果标识 base:返回基本地址信息 all:返回地址信息、附近POI、道路以及道路交叉口信息
     * @var string
     */
    private $extensions = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/around';
        $this->reqData['radius'] = 3000;
        $this->reqData['sortrule'] = 'distance';
        $this->reqData['offset'] = 10;
        $this->reqData['page'] = 1;
        $this->reqData['extensions'] = 'base';
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
     * @param array $keywordList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setKeywords(array $keywordList)
    {
        $keywords = [];
        foreach ($keywordList as $eKeyword) {
            if (is_string($eKeyword) && (strlen($eKeyword) > 0)) {
                $keywords[] = $eKeyword;
            }
        }
        array_unique($keywords);
        if (empty($keywords)) {
            throw new GaoDeMapException('关键字不能为空', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['keywords'] = implode('|', $keywords);
    }

    /**
     * @param array $typeList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setTypes(array $typeList)
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
        $this->reqData['types'] = implode('|', array_keys($types));
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
     * @param int $radius
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setRadius(int $radius)
    {
        if (($radius > 0) && ($radius <= 50000)) {
            $this->reqData['radius'] = $radius;
        } else {
            throw new GaoDeMapException('搜索半径不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param string $sortRule
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setSortRule(string $sortRule)
    {
        if (in_array($sortRule, ['distance', 'weight'], true)) {
            $this->reqData['sortrule'] = $sortRule;
        } else {
            throw new GaoDeMapException('排序规则不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param int $offset
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setOffset(int $offset)
    {
        if (($offset > 0) && ($offset <= 25)) {
            $this->reqData['offset'] = $offset;
        } else {
            throw new GaoDeMapException('每页记录数不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param int $page
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setPage(int $page)
    {
        if (($page > 0) && ($page <= 100)) {
            $this->reqData['page'] = $page;
        } else {
            throw new GaoDeMapException('当前页数不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
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
            throw new GaoDeMapException('返回结果标识不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['location'])) {
            throw new GaoDeMapException('中心点坐标不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
