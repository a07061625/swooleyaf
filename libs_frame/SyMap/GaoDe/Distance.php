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
 * 距离测量
 * @package Map\GaoDe
 */
class Distance extends MapBaseGaoDe
{
    /**
     * 出发点
     * @var string
     */
    private $origins = '';
    /**
     * 目的地
     * @var string
     */
    private $destination = '';
    /**
     * 距离计算类型 0:直线距离 1:驾车导航距离 2:公交规划距离 3:步行规划距离
     * @var int
     */
    private $type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/distance';
        $this->reqData['type'] = 1;
    }

    /**
     * @param array $originList
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setOrigins(array $originList)
    {
        $originNum = count($originList);
        if ($originNum == 0) {
            throw new GaoDeMapException('出发点不能为空', ErrorCode::MAP_GAODE_PARAM_ERROR);
        } elseif ($originNum > 100) {
            throw new GaoDeMapException('出发点不能超过100个', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
        $this->reqData['origins'] = implode('|', $originList);
    }

    /**
     * @param double $lat
     * @param double $lng
     */
    public function setDestination($lat, $lng)
    {
        $this->reqData['destination'] = $lng . ',' . $lat;
    }

    /**
     * @param int $type
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setType(int $type)
    {
        if (in_array($type, [0, 1, 2, 3], true)) {
            $this->reqData['type'] = $type;
        } else {
            throw new GaoDeMapException('距离计算类型不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['origins'])) {
            throw new GaoDeMapException('出发点不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }
        if (!isset($this->reqData['destination'])) {
            throw new GaoDeMapException('目的地不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
