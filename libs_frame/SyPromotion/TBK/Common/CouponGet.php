<?php
/**
 * 查询推广券详情
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:38
 */

namespace SyPromotion\TBK\Common;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class CouponGet
 *
 * @package SyPromotion\TBK\Common
 */
class CouponGet extends BaseTBK
{
    /**
     * 加密串
     *
     * @var string
     */
    private $me = '';
    /**
     * 商品ID
     *
     * @var int
     */
    private $item_id = 0;
    /**
     * 券ID
     *
     * @var string
     */
    private $activity_id = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.coupon.get');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setMe(string $me)
    {
        if (\strlen($me) > 0) {
            $this->reqData['me'] = $me;
        } else {
            throw new TBKException('加密串不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setItemIdAndActivityId(int $itemId, string $activityId)
    {
        if ($itemId <= 0) {
            throw new TBKException('商品ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!ctype_alnum($activityId)) {
            throw new TBKException('券ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['item_id'] = $itemId;
        $this->reqData['activity_id'] = $activityId;
    }

    public function getDetail(): array
    {
        if ((!isset($this->reqData['me'])) && !isset($this->reqData['item_id'])) {
            throw new TBKException('加密串和商品ID不能都为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
