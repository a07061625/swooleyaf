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
 * ID查询
 * @package Map\GaoDe
 */
class PlaceDetail extends MapBaseGaoDe
{
    /**
     * 兴趣点ID
     * @var string
     */
    private $id = '';

    public function __construct()
    {
        parent::__construct();
        $this->serviceUri = '/place/detail';
    }

    /**
     * @param string $id
     * @throws \SyException\Map\GaoDeMapException
     */
    public function setId(string $id)
    {
        if (ctype_alnum($id)) {
            $this->reqData['id'] = $id;
        } else {
            throw new GaoDeMapException('兴趣点ID不合法', ErrorCode::MAP_GAODE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['id'])) {
            throw new GaoDeMapException('兴趣点ID不能为空', ErrorCode::MAP_BAIDU_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
