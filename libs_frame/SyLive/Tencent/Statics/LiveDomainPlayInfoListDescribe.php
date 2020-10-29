<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 14:47
 */
namespace SyLive\Tencent\Statics;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 查询实时的域名维度下行播放数据
 *
 * @package SyLive\Tencent\Statics
 */
class LiveDomainPlayInfoListDescribe extends BaseTencent
{
    /**
     * 播放域名列表
     *
     * @var array
     */
    private $PlayDomains = [];

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveDomainPlayInfoList';
    }

    private function __clone()
    {
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

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
