<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 14:59
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 直播计费带宽和流量数据查询
 *
 * @package SyLive\Tencent\Statics
 */
class BillBandwidthAndFluxListDescribe extends BaseTencent
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
     * 播放域名列表
     *
     * @var array
     */
    private $PlayDomains = [];
    /**
     * 地域
     *
     * @var string
     */
    private $MainlandOrOversea = '';
    /**
     * 数据粒度
     *
     * @var int
     */
    private $Granularity = 0;
    /**
     * 服务名称
     *
     * @var string
     */
    private $ServiceName = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeBillBandwidthAndFluxList';
        $this->reqData['Granularity'] = 5;
        $this->reqData['ServiceName'] = 'LVB';
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

    /**
     * @param array $playDomains
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPlayDomains(array $playDomains)
    {
        $domains = [];
        foreach ($playDomains as $eDomain) {
            if (is_string($eDomain) && isset($eDomain[0])) {
                $domains[$eDomain] = 1;
            }
        }
        if (empty($domains)) {
            throw new TencentException('播放域名列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['PlayDomains'] = array_keys($domains);
    }

    /**
     * @param string $mainlandOrOversea
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMainlandOrOversea(string $mainlandOrOversea)
    {
        if (in_array($mainlandOrOversea, ['Mainland', 'Oversea'])) {
            $this->reqData['MainlandOrOversea'] = $mainlandOrOversea;
        } else {
            throw new TencentException('地域不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $granularity
     *
     * @throws \SyException\Live\TencentException
     */
    public function setGranularity(int $granularity)
    {
        if (in_array($granularity, [5, 60, 1440])) {
            $this->reqData['Granularity'] = $granularity;
        } else {
            throw new TencentException('数据粒度不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $serviceName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setServiceName(string $serviceName)
    {
        if (in_array($serviceName, ['LVB', 'LEB'])) {
            $this->reqData['ServiceName'] = $serviceName;
        } else {
            throw new TencentException('服务名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
