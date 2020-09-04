<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:11
 */
namespace SyLive\Tencent\Domain;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 添加域名
 *
 * @package SyLive\Tencent\Domain
 */
class DomainAdd extends BaseTencent
{
    /**
     * 域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 域名类型
     *
     * @var int
     */
    private $DomainType = 0;
    /**
     * 拉流域名类型
     *
     * @var int
     */
    private $PlayType = 0;
    /**
     * 慢直播标识
     *
     * @var int
     */
    private $IsDelayLive = 0;
    /**
     * 小程序直播标识
     *
     * @var int
     */
    private $IsMiniProgramLive = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'AddLiveDomain';
        $this->reqData['PlayType'] = 1;
        $this->reqData['IsDelayLive'] = 0;
        $this->reqData['IsMiniProgramLive'] = 0;
    }

    private function __clone()
    {
    }

    /**
     * @param string $domainName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setDomainName(string $domainName)
    {
        if (strlen($domainName) > 0) {
            $this->reqData['DomainName'] = $domainName;
        } else {
            throw new TencentException('域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
     * @param int $playType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setPlayType(int $playType)
    {
        if (in_array($playType, [1, 2, 3])) {
            $this->reqData['PlayType'] = $playType;
        } else {
            throw new TencentException('拉流域名类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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
     * @param int $isMiniProgramLive
     *
     * @throws \SyException\Live\TencentException
     */
    public function setIsMiniProgramLive(int $isMiniProgramLive)
    {
        if (in_array($isMiniProgramLive, [0, 1])) {
            $this->reqData['IsMiniProgramLive'] = $isMiniProgramLive;
        } else {
            throw new TencentException('小程序直播标识不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['DomainType'])) {
            throw new TencentException('域名类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
