<?php
/**
 * 渠道管理组团明细数据
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class DetailSubReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class DetailSubReport extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

    /**
     * 活动id
     *
     * @var int
     */
    private $event_id = 0;
    /**
     * 策略名称
     *
     * @var string
     */
    private $campaign_code = '';
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

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.cpa.report.sub.detail');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setEventId(int $eventId)
    {
        if ($eventId > 0) {
            $this->reqData['event_id'] = $eventId;
        } else {
            throw new TBKException('活动id不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setCampaignCode(string $campaignCode)
    {
        if (\strlen($campaignCode) > 0) {
            $this->reqData['campaign_code'] = $campaignCode;
        } else {
            throw new TBKException('策略名称不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['event_id'])) {
            throw new TBKException('活动id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['campaign_code'])) {
            throw new TBKException('策略名称不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
