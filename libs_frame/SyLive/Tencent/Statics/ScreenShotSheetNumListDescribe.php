<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:41
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询截图张数
 *
 * @package SyLive\Tencent\Statics
 */
class ScreenShotSheetNumListDescribe extends BaseTencent
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
    /**
     * 地域信息
     *
     * @var string
     */
    private $Zone = '';
    /**
     * 推流域名列表
     *
     * @var array
     */
    private $PushDomains = [];
    /**
     * 数据粒度
     *
     * @var string
     */
    private $Granularity = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeScreenShotSheetNumList';
        $this->reqData['Granularity'] = 'Day';
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
        $this->reqData['StartTime'] = date('Y-m-dTH:i:sZ', $startTime);
        $this->reqData['EndTime'] = date('Y-m-dTH:i:sZ', $endTime);
    }

    /**
     * @param string $zone
     *
     * @throws \SyException\Live\TencentException
     */
    public function setZone(string $zone)
    {
        if (in_array($zone, ['Mainland', 'Oversea'])) {
            $this->reqData['Zone'] = $zone;
        } else {
            throw new TencentException('地域信息不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param array $pushDomains
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPushDomains(array $pushDomains)
    {
        $domains = [];
        foreach ($pushDomains as $eDomain) {
            if (is_string($eDomain) && isset($eDomain[0])) {
                $domains[$eDomain] = 1;
            }
        }
        if (empty($domains)) {
            throw new TencentException('推流域名列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['PushDomains'] = array_keys($domains);
    }

    /**
     * @param string $granularity
     *
     * @throws \SyException\Live\TencentException
     */
    public function setGranularity(string $granularity)
    {
        if (in_array($granularity, ['Minute', 'Day'])) {
            $this->reqData['Granularity'] = $granularity;
        } else {
            throw new TencentException('数据粒度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
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
