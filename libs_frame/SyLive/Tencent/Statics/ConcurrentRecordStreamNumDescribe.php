<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:56
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询并发录制路数
 *
 * @package SyLive\Tencent\Statics
 */
class ConcurrentRecordStreamNumDescribe extends BaseTencent
{
    /**
     * 直播类型
     *
     * @var string
     */
    private $LiveType = '';
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
     * 地域
     *
     * @var string
     */
    private $MainlandOrOversea = '';
    /**
     * 推流域名列表
     *
     * @var array
     */
    private $PushDomains = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeConcurrentRecordStreamNum';
    }

    private function __clone()
    {
    }

    /**
     * @param string $liveType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setLiveType(string $liveType)
    {
        if (in_array($liveType, ['SlowLive', 'NormalLive'])) {
            $this->reqData['LiveType'] = $liveType;
        } else {
            throw new TencentException('地域不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['LiveType'])) {
            throw new TencentException('直播类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['StartTime'])) {
            throw new TencentException('开始时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
