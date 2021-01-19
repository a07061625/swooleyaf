<?php
/**
 * 购物车催付根据对应规则查询用户信息
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class UserQueryByCartCouponExpire
 *
 * @package SyPromotion\TBK\Common
 */
class UserQueryByCartCouponExpire extends BaseTBK
{
    use SetPageSizeTrait;

    /**
     * 规则ID
     *
     * @var string
     */
    private $rule_id = '';
    /**
     * 页码
     *
     * @var int
     */
    private $page_num = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.cart.coupon.expire.user.query');
        $this->reqData['page_num'] = 0;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setRuleId(string $ruleId)
    {
        if (\strlen($ruleId) > 0) {
            $this->reqData['rule_id'] = $ruleId;
        } else {
            throw new TBKException('规则ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPageNum(int $pageNum)
    {
        if ($pageNum >= 0) {
            $this->reqData['page_num'] = $pageNum;
        } else {
            throw new TBKException('页码不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['rule_id'])) {
            throw new TBKException('规则ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
