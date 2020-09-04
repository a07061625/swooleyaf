<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/9/3 0003
 * Time: 22:19
 */
namespace SyLive\Tencent\Cert;

use DesignPatterns\Singletons\LiveConfigSingleton;
use SyConstant\ErrorCode;
use SyException\Live\TencentException;
use SyLive\BaseTencent;

/**
 * 获取证书信息
 *
 * @package SyLive\Tencent\Cert
 */
class CertDescribe extends BaseTencent
{
    /**
     * 证书ID
     *
     * @var int
     */
    private $CertId = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'DescribeLiveCert';
    }

    private function __clone()
    {
    }

    /**
     * @param int $certId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCertId(int $certId)
    {
        if ($certId > 0) {
            $this->reqData['CertId'] = $certId;
        } else {
            throw new TencentException('证书ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['CertId'])) {
            throw new TencentException('证书ID不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
