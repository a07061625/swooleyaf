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
 * 添加证书
 *
 * @package SyLive\Tencent\Cert
 */
class CertCreate extends BaseTencent
{
    /**
     * 证书类型
     *
     * @var int
     */
    private $CertType = 0;
    /**
     * 证书名称
     *
     * @var string
     */
    private $CertName = '';
    /**
     * 公钥内容
     *
     * @var string
     */
    private $HttpsCrt = '';
    /**
     * 私钥内容
     *
     * @var string
     */
    private $HttpsKey = '';
    /**
     * 描述信息
     *
     * @var string
     */
    private $Description = '';
    /**
     * 腾讯云证书托管ID
     *
     * @var string
     */
    private $CloudCertId = '';

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'CreateLiveCert';
    }

    private function __clone()
    {
    }

    /**
     * @param int $certType
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCertType(int $certType)
    {
        if (in_array($certType, [0, 1])) {
            $this->reqData['CertType'] = $certType;
        } else {
            throw new TencentException('证书类型不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $certName
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCertName(string $certName)
    {
        if (strlen($certName) > 0) {
            $this->reqData['CertName'] = $certName;
        } else {
            throw new TencentException('证书名称不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $httpsCrt
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHttpsCrt(string $httpsCrt)
    {
        if (strlen($httpsCrt) > 0) {
            $this->reqData['HttpsCrt'] = $httpsCrt;
        } else {
            throw new TencentException('公钥内容不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $httpsKey
     *
     * @throws \SyException\Live\TencentException
     */
    public function setHttpsKey(string $httpsKey)
    {
        if (strlen($httpsKey) > 0) {
            $this->reqData['HttpsKey'] = $httpsKey;
        } else {
            throw new TencentException('私钥内容不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description)
    {
        $this->reqData['Description'] = trim($description);
    }

    /**
     * @param string $cloudCertId
     *
     * @throws \SyException\Live\TencentException
     */
    public function setCloudCertId(string $cloudCertId)
    {
        if (strlen($cloudCertId) > 0) {
            $this->reqData['CloudCertId'] = $cloudCertId;
        } else {
            throw new TencentException('腾讯云证书托管ID不合法', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->reqData['CertType'])) {
            throw new TencentException('证书类型不能为空', ErrorCode::LIVE_TENCENT_PARAM_ERROR);
        }

        $config = LiveConfigSingleton::getInstance()->getTencentConfig();
        $this->addReqSign($config->getSecretId(), $config->getSecretKey());

        return $this->getContent();
    }
}
