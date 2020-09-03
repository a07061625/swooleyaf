<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 15:10
 */
namespace SyLive;

use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class BaseBaiJiaSetting
 * @package SyLive
 */
abstract class BaseBaiJiaSetting extends BaseBaiJia
{
    /**
     * 产品类型 1:大班课 2:小班课 3:双师 4:企业直播
     * @var int
     */
    private $product_type = 0;

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
    }

    /**
     * @param int $productType
     * @throws \SyException\Live\BaiJiaException
     */
    public function setProductType(int $productType)
    {
        if (in_array($productType, [1, 2, 3, 4])) {
            $this->reqData['product_type'] = $productType;
        } else {
            throw new BaiJiaException('产品类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }
}
