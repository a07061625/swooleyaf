<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:14
 */
namespace SyLive\Tencent\Domain;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询域名列表
 *
 * @package SyLive\Tencent\Domain
 */
class DomainsDescribe extends BaseTencent
{
    /**
     * 域名状态
     *
     * @var int
     */
    private $DomainStatus = 0;
    /**
     * 域名类型
     *
     * @var int
     */
    private $DomainType = 0;
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
     * 慢直播标识
     *
     * @var int
     */
    private $IsDelayLive = 0;
    /**
     * 域名前缀
     *
     * @var string
     */
    private $DomainPrefix = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveDomains';
        $this->reqData['PageNum'] = 1;
        $this->reqData['PageSize'] = 10;
        $this->reqData['IsDelayLive'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param int $domainStatus
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDomainStatus(int $domainStatus)
    {
        if (in_array($domainStatus, [0, 1])) {
            $this->reqData['DomainStatus'] = $domainStatus;
        } else {
            throw new TencentException('域名状态不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $domainType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDomainType(int $domainType)
    {
        if (in_array($domainType, [0, 1])) {
            $this->reqData['DomainType'] = $domainType;
        } else {
            throw new TencentException('域名类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $pageNum
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPageNum(int $pageNum)
    {
        if (($pageNum > 0) && ($pageNum <= 100000)) {
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
        if (($pageSize >= 10) && ($pageSize <= 100)) {
            $this->reqData['PageSize'] = $pageSize;
        } else {
            throw new TencentException('每页个数不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param int $isDelayLive
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsDelayLive(int $isDelayLive)
    {
        if (in_array($isDelayLive, [0, 1])) {
            $this->reqData['IsDelayLive'] = $isDelayLive;
        } else {
            throw new TencentException('慢直播标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $domainPrefix
     */
    public function setDomainPrefix(string $domainPrefix)
    {
        $this->reqData['DomainPrefix'] = trim($domainPrefix);
    }

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
