<?php
/**
 * 获取账号视频播放量
 * User: 姜伟
 * Date: 2020/4/1 0001
 * Time: 19:22
 */
namespace SyLive\BaiJia\VodVideoData;

use SyLive\BaseBaiJia;
use SyLive\UtilBaiJia;
use SyConstant\ErrorCode;
use SyException\Live\BaiJiaException;

/**
 * Class PartnerDailyPlayCountGet
 * @package SyLive\BaiJia\VodVideoData
 */
class PartnerDailyPlayCountGet extends BaseBaiJia
{
    /**
     * 产品类型 1:教育直播 2:小班课 3:双师 4:企业直播 5:点播账号
     * @var int
     */
    private $product_type = 0;
    /**
     * 起始日期
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
        $this->serviceUri = '/openapi/video_data/getPartnerDailyPlayCount';
    }

    private function __clone()
    {
    }

    /**
     * @param int $productType
     * @throws \SyException\Live\BaiJiaException
     */
    public function setProductType(int $productType)
    {
        if (in_array($productType, [1, 2, 3, 4, 5])) {
            $this->reqData['product_type'] = $productType;
        } else {
            throw new BaiJiaException('产品类型不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
    }

    /**
     * @param int $startTime
     * @param int $endTime
     * @throws \SyException\Live\BaiJiaException
     */
    public function setDate(int $startTime, int $endTime)
    {
        if ($startTime <= 0) {
            throw new BaiJiaException('起始时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($endTime <= 0) {
            throw new BaiJiaException('结束时间不合法', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        } elseif ($startTime > $endTime) {
            throw new BaiJiaException('起始时间不能大于结束时间', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        $this->reqData['start_date'] = date('Y-m-d', $startTime);
        $this->reqData['end_date'] = date('Y-m-d', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['start_date'])) {
            throw new BaiJiaException('起始日期不能为空', ErrorCode::LIVE_BAIJIA_PARAM_ERROR);
        }
        UtilBaiJia::createSign($this->partnerId, $this->reqData);

        return $this->getContent();
    }
}
