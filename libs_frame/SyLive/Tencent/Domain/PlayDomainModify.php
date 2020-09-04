<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 16:06
 */
namespace SyLive\Tencent\Domain;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 修改播放域名信息
 *
 * @package SyLive\Tencent\Domain
 */
class PlayDomainModify extends BaseTencent
{
    /**
     * 播放域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 拉流域名类型
     *
     * @var int
     */
    private $PlayType = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLivePlayDomain';
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
            throw new TencentException('播放域名不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
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

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('播放域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
        if (!isset($this->reqData['PlayType'])) {
            throw new TencentException('拉流域名类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
