<?php
/**
 * 查询直播账号指定日期中各教室使用的人次
 * User: 姜伟
 * Date: 2020/3/30 0030
 * Time: 11:50
 */
namespace SyLive\BaiJia\LiveLargeClass\LiveAccount;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class RoomCostGet
 * @package SyLive\BaiJia\LiveLargeClass\LiveAccount
 */
class RoomCostGet extends BaseBaiJia
{
    /**
     * 产品类型 1:教育直播
     * @var int
     */
    private $product_type = 0;
    /**
     * 日期
     * @var string
     */
    private $date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/getAllRoomCost';
        $this->reqData['product_type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $dateTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $dateTime)
    {
        if ($dateTime > 0) {
            $this->reqData['date'] = date('Y-m-d', $dateTime);
        } else {
            throw new BaiJiaException('日期不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['date'])) {
            throw new BaiJiaException('日期不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
