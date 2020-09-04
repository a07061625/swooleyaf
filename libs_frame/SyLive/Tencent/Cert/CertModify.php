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
 * 修改证书
 *
 * @package SyLive\Tencent\Cert
 */
class CertModify extends BaseTencent
{
    /**
     * 证书ID
     *
     * @var int
     */
    private $CertId = 0;
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

    public function __construct()
    {
        parent::__construct();
        $this->reqHeader['X-TC-Action'] = 'ModifyLiveCert';
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
