<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/3/31 0031
 * Time: 15:10
 */
namespace LiveEducation\BJY\Setting;

use LiveEducation\BaseBJY;
use SyConstant\ErrorCode;
use SyException\LiveEducation\BJYException;

/**
 * Class BaseSetting
 * @package LiveEducation\BJY\Setting
 */
abstract class BaseSetting extends BaseBJY
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
     * @throws \SyException\LiveEducation\BJYException
     */
    public function setProductType(int $productType)
    {
        if (in_array($productType, [1, 2, 3, 4])) {
            $this->reqData['product_type'] = $productType;
        } else {
            throw new BJYException('产品类型不合法', ErrorCode::LIVE_EDUCATION_PARAM_ERROR);
        }
    }
}
