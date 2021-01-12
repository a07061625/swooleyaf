<?php
/**
 * 查询返利订单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Promoter;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetFieldsTrait;
use SyPromotion\TBK\Traits\SetPageNoTrait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class RebateOrderGet
 *
 * @package SyPromotion\TBK\Promoter
 */
class RebateOrderGet extends BaseTBK
{
    use SetFieldsTrait;
    use SetPageNoTrait;
    use SetPageSizeTrait;

    /**
     * 返回字段列表
     *
     * @var array
     */
    private $fields = [];
    /**
     * 订单结算开始时间
     *
     * @var int
     */
    private $start_time = 0;
    /**
     * 订单查询时间范围,单位:秒
     *
     * @var int
     */
    private $span = 0;
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
        $this->setMethod('taobao.tbk.rebate.order.get');
        $this->reqData['span'] = 60;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setStartTime(int $startTime)
    {
        if ($startTime > 1262275200) {
            $this->reqData['start_time'] = date('Y-h-d H:i:s', $startTime);
        } else {
            throw new TBKException('订单结算开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSpan(int $span)
    {
        if (($span >= 60) && ($span <= 600)) {
            $this->reqData['span'] = $span;
        } else {
            throw new TBKException('订单查询时间范围不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['fields'])) {
            throw new TBKException('返回字段列表不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (!isset($this->reqData['start_time'])) {
            throw new TBKException('订单结算开始时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
