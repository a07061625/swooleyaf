<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:39
 */
namespace SyPay;

use SyConstant\ErrorCode;
use SyException\Pay\UnionException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigUnionChannels
 * 证书上传导出请参考 https://open.unionpay.com/tjweb/doc/mchnt/list?cateLog=agreement
 *
 * @package SyPay
 */
class ConfigUnionChannels
{
    use SimpleConfigTrait;

    /**
     * 商户号
     *
     * @var string
     */
    private $merId = '';
    /**
     * 证书公钥ID
     *
     * @var string
     */
    private $certPublicId = '';
    /**
     * 证书公钥
     *
     * @var string
     */
    private $certPublicKey = '';
    /**
     * 证书私钥ID
     *
     * @var string
     */
    private $certPrivateId = '';
    /**
     * 证书私钥
     *
     * @var string
     */
    private $certPrivateKey = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getMerId() : string
    {
        return $this->merId;
    }

    /**
     * @param string $merId
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setMerId(string $merId)
    {
        if (ctype_digit($merId)) {
            $this->merId = $merId;
        } else {
            throw new UnionException('商户号不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getCertPublicId() : string
    {
        return $this->certPublicId;
    }

    /**
     * @return string
     */
    public function getCertPublicKey() : string
    {
        return $this->certPublicKey;
    }

    /**
     * @param string $certContent 公钥证书内容,不是证书文件,证书文件后缀为.cer
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCertPublic(string $certContent)
    {
        openssl_x509_read($certContent);
        $certData = openssl_x509_parse($certContent);
        if (is_bool($certData)) {
            throw new UnionException('公钥证书不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        $this->certPublicId = $certData['serialNumber'];
        $this->certPublicKey = $certContent;
    }

    /**
     * @return string
     */
    public function getCertPrivateId() : string
    {
        return $this->certPrivateId;
    }

    /**
     * @return string
     */
    public function getCertPrivateKey() : string
    {
        return $this->certPrivateKey;
    }

    /**
     * @param string $certContent 私钥证书内容,不是证书文件,证书文件后缀为.pfx
     * @param string $certPwd     私钥证书密码
     *
     * @throws \SyException\Pay\UnionException
     */
    public function setCertPrivate(string $certContent, string $certPwd)
    {
        $certs = [];
        if (!openssl_pkcs12_read($certContent, $certs, $certPwd)) {
            throw new UnionException('私钥证书读取出错', ErrorCode::PAY_UNION_PARAM_ERROR);
        }

        $x509data = $certs ['cert'];
        openssl_x509_read($x509data);
        $certData = openssl_x509_parse($x509data);
        if (is_bool($certData)) {
            throw new UnionException('私钥证书不合法', ErrorCode::PAY_UNION_PARAM_ERROR);
        }
        $this->certPrivateId = $certData['serialNumber'];
        $this->certPrivateKey = $certData['pkey'];
    }
}
