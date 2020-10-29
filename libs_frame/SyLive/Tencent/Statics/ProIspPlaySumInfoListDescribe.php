<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 15:28
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询分省份分运营商播放汇总数据
 *
 * @package SyLive\Tencent\Statics
 */
class ProIspPlaySumInfoListDescribe extends BaseTencent
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
     * 页数,默认1
     *
     * @var int
     */
    private $PageNum = 0;
    /**
     * 每页个数,默认20
     *
     * @var int
     */
    private $PageSize = 0;
    /**
     * 地域
     *
     * @var string
     */
    private $MainlandOrOversea = '';
    /**
     * 输出语言
     *
     * @var string
     */
    private $OutLanguage = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeProIspPlaySumInfoList';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 20;
        $this->reqData['MainlandOrOversea'] = 'Global';
        $this->reqData['OutLanguage'] = 'Chinese';
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
        if (in_array($statType, ['Province', 'Isp', 'CountryOrArea'])) {
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
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if (($pageNum > 0) && ($pageNum <= 1000)) {
            $this->reqData['PageNum'] = $pageNum;
        } else {
            throw new TencentException('页数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageSize
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageSize(int $pageSize)
    {
        if (($pageSize >= 1) && ($pageSize <= 1000)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
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

    /**
     * @param string $outLanguage
     *
     * @throws \SyException\Live\TencentException
     */
    public function setOutLanguage(string $outLanguage)
    {
        if (in_array($outLanguage, ['Chinese', 'English'])) {
            $this->reqData['OutLanguage'] = $outLanguage;
        } else {
            throw new TencentException('输出语言不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
