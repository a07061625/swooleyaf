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
 * 关键字搜索
 * @package Map\GaoDe
 */
class PlaceText extends MapBaseGaoDe
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
    private $types = '';
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
     * 层级展示标识 0:子POI都会显示 1:子POI会归类到父POI之中
     * @var int
     */
    private $children = 0;
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
     * POI编号
     * @var string
     */
    private $building = '';
    /**
     * 楼层
     * @var int
     */
    private $floor = 0;
    /**
     * 返回结果标识 base:返回基本地址信息 all:返回地址信息、附近POI、道路以及道路交叉口信息
     * @var string
     */
    private $extensions = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/text';
        $this->reqData['citylimit'] = 'false';
        $this->reqData['children'] = 0;
        $this->reqData['offset'] = 10;
        $this->reqData['page'] = 1;
        $this->reqData['extensions'] = 'base';
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
     * @param string $types
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setTypes(string $types)
    {
        if (ctype_digit($types) && (strlen($types) == 6)) {
            $this->reqData['types'] = $types;
        } else {
            throw new GaoDeMapException('POI类型不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
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
     * @param int $children
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setChildren(int $children)
    {
        if (in_array($children, [0, 1], true)) {
            $this->reqData['children'] = $children;
        } else {
            throw new GaoDeMapException('层级展示标识不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
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
     * @param string $building
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setBuilding(string $building)
    {
        if (ctype_alnum($building)) {
            $this->reqData['building'] = $building;
        } else {
            throw new GaoDeMapException('POI编号不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    /**
     * @param int $floor
     */
    public function setFloor(int $floor)
    {
        $this->reqData['floor'] = $floor;
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
        if ((!isset($this->reqData['keywords'])) && !isset($this->reqData['types'])) {
            throw new GaoDeMapException('关键字和POI类型不能同时为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
