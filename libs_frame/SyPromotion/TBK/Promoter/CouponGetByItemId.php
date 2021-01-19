<?php
/**
 * 根据宝贝id批量查询优惠券
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetNumIidsTrait;
use SyPromotion\TBK\Traits\SetPlatformTrait;

/**
 * Class CouponGetByItemId
 *
 * @package SyPromotion\TBK\Promoter
 */
class CouponGetByItemId extends BaseTBK
{
    use SetPlatformTrait;
    use SetNumIidsTrait;

    /**
     * 链接形式 1:PC 2:无线 默认１
     *
     * @var int
     */
    private $platform = 0;
    /**
     * 三方pid
     *
     * @var string
     */
    private $pid = '';
    /**
     * 商品ID列表
     *
     * @var array
     */
    private $num_iids = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.itemid.coupon.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPid(string $pid)
    {
        if (preg_match(ProjectBase::REGEX_PROMOTION_TBK_PID, $pid) > 0) {
            $this->reqData['pid'] = $pid;
        } else {
            throw new TBKException('三方pid不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['pid'])) {
            throw new TBKException('三方pid不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
