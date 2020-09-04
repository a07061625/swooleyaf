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
 * 修改域名和证书绑定信息
 *
 * @package SyLive\Tencent\Cert
 */
class DomainCertModify extends BaseTencent
{
    /**
     * 播放域名
     *
     * @var string
     */
    private $DomainName = '';
    /**
     * 证书ID
     *
     * @var int
     */
    private $CertId = 0;
    /**
     * 状态
     *
     * @var int
     */
    private $Status = 0;

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLiveDomainCert';
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

    /**
     * @param int $status
     *
     * @throws \SyException\Live\TencentException
     */
    public function setStatus(int $status)
    {
        if (in_array($status, [0, 1])) {
            $this->reqData['Status'] = $status;
        } else {
            throw new TencentException('状态不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['DomainName'])) {
            throw new TencentException('播放域名不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
