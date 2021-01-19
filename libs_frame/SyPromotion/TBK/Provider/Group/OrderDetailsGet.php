<?php
/**
 * 所有订单查询
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */

namespace SyPromotion\TBK\Provider\Group;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;
use SyPromotion\TBK\Traits\SetPageNo2Trait;
use SyPromotion\TBK\Traits\SetPageSizeTrait;

/**
 * Class OrderDetailsGet
 *
 * @package SyPromotion\TBK\Provider\Group
 */
class OrderDetailsGet extends BaseTBK
{
    use SetPageNo2Trait;
    use SetPageSizeTrait;

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
     * 查询时间类型 1:按照订单淘客创建时间查询 2:按照订单淘客付款时间查询 3:按照订单淘客结算时间查询
     *
     * @var int
     */
    private $query_type = 0;
    /**
     * 位点
     *
     * @var string
     */
    private $position_index = '';
    /**
     * 淘客订单状态 12-付款 13-关闭 14-确认收货 3-结算成功
     *
     * @var int
     */
    private $tk_status = 0;
    /**
     * 查询开始时间
     *
     * @var int
     */
    private $start_time = 0;
    /**
     * 查询结束时间
     *
     * @var int
     */
    private $end_time = 0;
    /**
     * 跳转类型
     *
     * @var int
     */
    private $jump_type = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.cp.order.details.get');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['jump_type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setQueryType(int $queryType)
    {
        if (\in_array($queryType, [1, 2, 3])) {
            $this->reqData['query_type'] = $queryType;
        } else {
            throw new TBKException('查询时间类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setPositionIndex(string $positionIndex)
    {
        if (\strlen($positionIndex) > 0) {
            $this->reqData['position_index'] = $positionIndex;
        } else {
            throw new TBKException('位点不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTkStatus(int $tkStatus)
    {
        if (\in_array($tkStatus, [12, 13, 14, 3])) {
            $this->reqData['tk_status'] = $tkStatus;
        } else {
            throw new TBKException('淘客订单状态不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime <= 1262275200) {
            throw new TBKException('查询开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($endTime <= 1262275200) {
            throw new TBKException('查询结束时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if ($endTime < $startTime) {
            throw new TBKException('查询结束时间不能小于开始时间', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        if (($endTime - $startTime) > 10800) {
            throw new TBKException('查询结束时间不能超过开始时间3小时', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    /**
     * @throws \SyException\Promotion\TBKException
     */
    public function setJumpType(int $jumpType)
    {
        if (\in_array($jumpType, [-1, 1])) {
            $this->reqData['jump_type'] = $jumpType;
        } else {
            throw new TBKException('跳转类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail(): array
    {
        if (!isset($this->reqData['start_time'])) {
            throw new TBKException('查询开始时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
