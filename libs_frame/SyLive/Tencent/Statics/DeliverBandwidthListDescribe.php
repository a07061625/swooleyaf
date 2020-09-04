<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:08
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询直播转推计费带宽
 *
 * @package SyLive\Tencent\Statics
 */
class DeliverBandwidthListDescribe extends BaseTencent
{
    /**
     * 开始时间
     *
     * @var int
     */
    private $StartTime = 0;
    /**
     * 结束时间
     *
     * @var int
     */
    private $EndTime = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeDeliverBandwidthList';
    }

    private function __clone()
    {
    }

    /**
     * @param int $startTime
     * @param int $endTime
     *
     * @throws \SyException\Live\TencentException
     */
    public function setTime(int $startTime, int $endTime)
    {
        if ($startTime < 1262275200) {
            throw new TencentException('开始时间不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        } elseif ($endTime < $startTime) {
            throw new TencentException('结束时间不能小于开始时间', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['StartTime'] = date('Y-m-d H:i:s', $startTime);
        $this->reqData['EndTime'] = date('Y-m-d H:i:s', $endTime);
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['StartTime'])) {
            throw new TencentException('开始时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
