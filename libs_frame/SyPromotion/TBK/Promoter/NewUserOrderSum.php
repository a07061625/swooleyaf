<?php
/**
 * 查询拉新活动汇总数据
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetAdZoneIdTrait;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;
use SyPromotion\TBK\Traits\SetSiteIdTrait;

/**
 * Class NewUserOrderSum
 *
 * @package SyPromotion\TBK\Promoter
 */
class NewUserOrderSum extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;
    use SetAdZoneIdTrait;
    use SetSiteIdTrait;

    /**
     * 页数
     *
     * @var int
     */
    private $page_no = 0;
    /**
     * 每页记录数
     *
     * @var int
     */
    private $page_size = 0;
    /**
     * 广告位ID
     *
     * @var int
     */
    private $adzone_id = 0;
    /**
     * 站点ID
     *
     * @var int
     */
    private $site_id = 0;
    /**
     * 活动ID
     *
     * @var string
     */
    private $activity_id = '';
    /**
     * 结算月份
     *
     * @var string
     */
    private $settle_month = '';

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.newuser.order.sum');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setActivityId(string $activityId)
    {
        if (\strlen($activityId) > 0) {
            $this->reqData['activity_id'] = $activityId;
        } else {
            throw new TBKException('活动ID不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSettleMonth(string $settleMonth)
    {
        if (ctype_digit($settleMonth) && (6 == \strlen($settleMonth))) {
            $this->reqData['settle_month'] = $settleMonth;
        } else {
            throw new TBKException('结算月份不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['activity_id'])) {
            throw new TBKException('活动ID不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
