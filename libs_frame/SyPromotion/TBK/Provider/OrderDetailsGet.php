<?php
/**
 * 查询所有订单
 * User: 姜伟
 * Date: 2021/1/10 0010
 * Time: 10:40
 */
namespace SyPromotion\TBK\Provider;

use SyConstant\ErrorCode;
use SyException\Promotion\TBKException;
use SyPromotion\BaseTBK;

/**
 * Class OrderDetailsGet
 * @package SyPromotion\TBK\Provider
 */
class OrderDetailsGet extends BaseTBK
{
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
     * 推广者角色类型
     *
     * @var int
     */
    private $member_type = 0;
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
    /**
     * 场景类型 1:常规订单 2:渠道订单 3:会员运营订单
     *
     * @var int
     */
    private $order_scene = 0;

    public function __construct()
    {
        parent::__construct();
        $this->setMethod('taobao.tbk.sc.order.details.get');
        $this->reqData['page_no'] = 1;
        $this->reqData['page_size'] = 20;
        $this->reqData['jump_type'] = 1;
        $this->reqData['order_scene'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $queryType
     * @throws \SyException\Promotion\TBKException
     */
    public function setQueryType(int $queryType)
    {
        if (in_array($queryType, [1, 2, 3])) {
            $this->reqData['query_type'] = $queryType;
        } else {
            throw new TBKException('查询时间类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param string $positionIndex
     * @throws \SyException\Promotion\TBKException
     */
    public function setPositionIndex(string $positionIndex)
    {
        if (strlen($positionIndex) > 0) {
            $this->reqData['position_index'] = $positionIndex;
        } else {
            throw new TBKException('位点不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $memberType
     * @throws \SyException\Promotion\TBKException
     */
    public function setMemberType(int $memberType)
    {
        if (in_array($memberType, [2, 3])) {
            $this->reqData['member_type'] = $memberType;
        } else {
            throw new TBKException('推广者角色类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $tkStatus
     * @throws \SyException\Promotion\TBKException
     */
    public function setTkStatus(int $tkStatus)
    {
        if (in_array($tkStatus, [12, 13, 14, 3])) {
            $this->reqData['tk_status'] = $tkStatus;
        } else {
            throw new TBKException('淘客订单状态不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Promotion\TBKException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime <= 1262275200) {
            throw new TBKException('查询开始时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        } elseif ($endTime <= 1262275200) {
            throw new TBKException('查询结束时间不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TBKException('查询结束时间不能小于开始时间', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        } elseif (($endTime - $startTime) > 10800) {
            throw new TBKException('查询结束时间不能超过开始时间3小时', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
        $this->reqData['start_time'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['end_time'] = date('Y-m-d H:i:s', $endTime);
    }

    /**
     * @param int $jumpType
     * @throws \SyException\Promotion\TBKException
     */
    public function setJumpType(int $jumpType)
    {
        if (in_array($jumpType, [-1, 1])) {
            $this->reqData['jump_type'] = $jumpType;
        } else {
            throw new TBKException('跳转类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    /**
     * @param int $orderScene
     * @throws \SyException\Promotion\TBKException
     */
    public function setOrderScene(int $orderScene)
    {
        if (in_array($orderScene, [1, 2, 3])) {
            $this->reqData['order_scene'] = $orderScene;
        } else {
            throw new TBKException('场景类型不合法', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_time'])) {
            throw new TBKException('查询开始时间不能为空', ErrorCode::PROMOTION_TBK_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
