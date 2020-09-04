<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 22:19
 */
namespace SyLive\Tencent\Cert;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyLive\BaseTencent;

/**
 * 获取证书信息列表
 *
 * @package SyLive\Tencent\Cert
 */
class CertsDescribe extends BaseTencent
{
    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveCerts';
    }

    private function __clone()
    {
    }

    public function getDetail() : array
    {
        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
