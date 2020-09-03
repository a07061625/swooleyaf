<?php
/**
 * 查询直播账号每天使用的人次
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
 * Class PartnerDailyCostGet
 * @package SyLive\BaiJia\LiveLargeClass\LiveAccount
 */
class PartnerDailyCostGet extends BaseBaiJia
{
    /**
     * 产品类型 1:教育直播
     * @var int
     */
    private $product_type = 0;
    /**
     * 开始日期
     * @var string
     */
    private $start_date = '';
    /**
     * 结束日期
     * @var string
     */
    private $end_date = '';

    public function __construct(string $partnerId)
    {
        parent::__construct($partnerId);
        $this->serviceUri = '/openapi/live_account/getPartnerDailyCost';
        $this->reqData['product_type'] = 1;
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BaiJiaException('开始时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new BaiJiaException('开始时间不能大于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['start_date'] = date('Y-m-d', $startTime);
        $this->reqData['end_date'] = date('Y-m-d', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_date'])) {
            throw new BaiJiaException('开始时间不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
