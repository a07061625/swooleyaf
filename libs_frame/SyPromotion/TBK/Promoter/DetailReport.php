<?php
/**
 * 渠道管理组团汇总数据
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class DetailReport
 *
 * @package SyPromotion\TBK\Promoter
 */
class DetailReport extends BaseTBK
{
    /**
     * 活动id
     *
     * @var int
     */
    private $event_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.dg.cpa.report.detail');
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

    public function getDetail(): array
    {
        if (!isset($this->reqData['event_id'])) {
            throw new TBKException('活动id不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
