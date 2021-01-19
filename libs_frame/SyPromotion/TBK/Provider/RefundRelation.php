<?php
/**
 * 查询维权退款订单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyTool\Tool;

/**
 * Class RefundRelation
 *
 * @package SyPromotion\TBK\Provider
 */
class RefundRelation extends BaseTBK
{
    /**
     * 查询参数
     *
     * @var array
     */
    private $search_option = [];

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.relation.refund');
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setSearchOption(array $searchOption)
    {
        $trueOption = [];
        $pageSize = \is_int($searchOption['page_size']) ? $searchOption['page_size'] : 20;
        if (($pageSize > 0) && ($pageSize <= 100)) {
            $trueOption['page_size'] = $pageSize;
        } else {
            throw new TBKException('每页记录数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $searchType = \is_int($searchOption['search_type']) ? $searchOption['search_type'] : 0;
        if (\in_array($searchType, [1, 2, 3, 4])) {
            $trueOption['search_type'] = $searchType;
        } else {
            throw new TBKException('查询类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $refundType = \is_int($searchOption['refund_type']) ? $searchOption['refund_type'] : 0;
        if (\in_array($refundType, [0, 1, 2])) {
            $trueOption['refund_type'] = $refundType;
        } else {
            throw new TBKException('退款类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $startTime = \is_int($searchOption['start_time']) ? $searchOption['start_time'] : 0;
        if ($startTime > 1262275200) {
            $trueOption['start_time'] = date('Y-m-d H:i:s', $startTime);
        } else {
            throw new TBKException('开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $pageNo = \is_int($searchOption['page_no']) ? $searchOption['page_no'] : 1;
        if ($pageNo > 0) {
            $trueOption['page_no'] = $pageNo;
        } else {
            throw new TBKException('页数不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $bizType = \is_int($searchOption['biz_type']) ? $searchOption['biz_type'] : 0;
        if (\in_array($bizType, [1, 2])) {
            $trueOption['biz_type'] = $bizType;
        } else {
            throw new TBKException('关系类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        $this->reqData['search_option'] = Tool::jsonEncode($trueOption, JSON_UNESCAPED_UNICODE);
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['search_option'])) {
            throw new TBKException('查询参数不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
