<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:19
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 按省份运营商查询播放信息
 *
 * @package SyLive\Tencent\Statics
 */
class ProvinceIspPlayInfoListDescribe extends BaseTencent
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
     * 查询粒度
     *
     * @var int
     */
    private $Granularity = 0;
    /**
     * 统计指标类型
     *
     * @var string
     */
    private $StatType = '';
    /**
     * 播放域名列表
     *
     * @var array
     */
    private $PlayDomains = [];
    /**
     * 省份列表
     *
     * @var array
     */
    private $ProvinceNames = [];
    /**
     * 运营商列表
     *
     * @var array
     */
    private $IspNames = [];
    /**
     * 地域
     *
     * @var string
     */
    private $MainlandOrOversea = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeProvinceIspPlayInfoList';
        $this->reqData['Granularity'] = 1;
        $this->reqData['MainlandOrOversea'] = 'Global';
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
     * @param string $statType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setStatType(string $statType)
    {
        if (in_array($statType, ['Bandwidth', 'FluxPerSecond', 'Flux', 'Request', 'Online'])) {
            $this->reqData['StatType'] = $statType;
        } else {
            throw new TencentException('统计指标类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
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
     * @param array $provinceNames
     *
     * @throws \SyException\Live\TencentException
     */
    public function setProvinceNames(array $provinceNames)
    {
        $names = [];
        foreach ($provinceNames as $eName) {
            if (is_string($eName) && isset($eName[0])) {
                $names[$eName] = 1;
            }
        }
        if (empty($names)) {
            throw new TencentException('省份列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['ProvinceNames'] = array_keys($names);
    }

    /**
     * @param array $ispNames
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIspNames(array $ispNames)
    {
        $names = [];
        foreach ($ispNames as $eName) {
            if (is_string($eName) && isset($eName[0])) {
                $names[$eName] = 1;
            }
        }
        if (empty($names)) {
            throw new TencentException('运营商列表不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        $this->reqData['IspNames'] = array_keys($names);
    }

    /**
     * @param string $mainlandOrOversea
     *
     * @throws \SyException\Live\TencentException
     */
    public function setMainlandOrOversea(string $mainlandOrOversea)
    {
        if (in_array($mainlandOrOversea, ['Mainland', 'Oversea', 'China', 'Foreign', 'Global'])) {
            $this->reqData['MainlandOrOversea'] = $mainlandOrOversea;
        } else {
            throw new TencentException('地域不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['StartTime'])) {
            throw new TencentException('开始时间不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['StatType'])) {
            throw new TencentException('统计指标类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
