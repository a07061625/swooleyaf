<?php
/**
 * 微信商户平台配置类
 * User: 姜伟
 * Date: 2017/6/13 0013
 * Time: 19:01
 */

namespace Wx;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Wx\WxException;
use SyTool\Tool;
use SyTrait\SimpleConfigTrait;

class WxConfigAccount
{
    use SimpleConfigTrait;

    /**
     * 客户端IP
     *
     * @var string
     */
    private $clientIp = '';

    /**
     * 原始ID
     *
     * @var string
     */
    private $originId = '';

    /**
     * 微信号
     *
     * @var string
     */
    private $appId = '';

    /**
     * 微信随机密钥
     *
     * @var string
     */
    private $secret = '';

    /**
     * 商户号
     *
     * @var string
     */
    private $payMchId = '';

    /**
     * 商户支付密钥
     *
     * @var string
     */
    private $payKey = '';

    /**
     * 支付异步通知URL
     *
     * @var string
     */
    private $payNotifyUrl = '';

    /**
     * 支付授权URL
     *
     * @var string
     */
    private $payAuthUrl = '';

    /**
     * CERT PEM证书内容,保持和原文件相同
     *
     * @var string
     */
    private $sslCert = '';

    /**
     * KEY PEM证书内容,保持和原文件相同
     *
     * @var string
     */
    private $sslKey = '';

    /**
     * API V3 密钥
     *
     * @var string
     */
    private $v3Key = '';

    /**
     * API V3 PEM证书序列号
     * 获取方式: openssl x509 -in 1900009191_20180326_cert.pem -noout -serial
     *
     * @var string
     */
    private $v3SerialNo = '';

    /**
     * API V3 PEM证书算法
     * 获取方式: https://myssl.com/cert_decode.html
     *
     * @var string
     */
    private $v3Algorithm = '';

    /**
     * API V3 PEM证书随机字符串
     *
     * @var string
     */
    private $v3Nonce = '';

    /**
     * API V3 PEM证书关联数据
     *
     * @var string
     */
    private $v3AssociatedData = '';

    /**
     * API V3 PEM证书密文
     *
     * @var string
     */
    private $v3CipherText = '';

    /**
     * 企业付款银行卡公钥内容
     *
     * @var string
     */
    private $sslCompanyBank = '';

    /**
     * 模板列表
     *
     * @var array
     */
    private $templates = [];

    /**
     * 服务商微信号
     *
     * @var string
     */
    private $merchantAppId = '';

    public function __construct()
    {
        //do nothing
    }

    private function __clone()
    {
        //do nothing
    }

    public function __toString()
    {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    public function getClientIp(): string
    {
        return $this->clientIp;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setClientIp(string $clientIp)
    {
        if (preg_match(ProjectBase::REGEX_IP, '.' . $clientIp) > 0) {
            $this->clientIp = $clientIp;
        } else {
            throw new WxException('客户端IP不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getOriginId(): string
    {
        return $this->originId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setOriginId(string $originId)
    {
        if (preg_match(ProjectBase::REGEX_WX_ORIGIN_ID, $originId) > 0) {
            $this->originId = $originId;
        } else {
            throw new WxException('原始ID不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setAppId(string $appId)
    {
        if (ctype_alnum($appId) && (18 == \strlen($appId))) {
            $this->appId = $appId;
        } else {
            throw new WxException('app id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setSecret(string $secret)
    {
        if (ctype_alnum($secret) && (32 == \strlen($secret))) {
            $this->secret = $secret;
        } else {
            throw new WxException('secret不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayMchId(): string
    {
        return $this->payMchId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPayMchId(string $payMchId)
    {
        if (ctype_digit($payMchId)) {
            $this->payMchId = $payMchId;
        } else {
            throw new WxException('商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayKey(): string
    {
        return $this->payKey;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPayKey(string $payKey)
    {
        if (ctype_alnum($payKey) && (32 == \strlen($payKey))) {
            $this->payKey = $payKey;
        } else {
            throw new WxException('支付密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayNotifyUrl(): string
    {
        return $this->payNotifyUrl;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPayNotifyUrl(string $payNotifyUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $payNotifyUrl) > 0) {
            $this->payNotifyUrl = $payNotifyUrl;
        } else {
            throw new WxException('支付异步消息通知URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getPayAuthUrl(): string
    {
        return $this->payAuthUrl;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setPayAuthUrl(string $payAuthUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $payAuthUrl) > 0) {
            $this->payAuthUrl = $payAuthUrl;
        } else {
            throw new WxException('支付授权URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getSslCert(): string
    {
        return $this->sslCert;
    }

    public function setSslCert(string $sslCert)
    {
        $this->sslCert = $sslCert;
    }

    public function getSslKey(): string
    {
        return $this->sslKey;
    }

    public function setSslKey(string $sslKey)
    {
        $this->sslKey = $sslKey;
    }

    public function getV3Key(): string
    {
        return $this->v3Key;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setV3Key(string $v3Key)
    {
        if (32 == \strlen($v3Key)) {
            $this->v3Key = $v3Key;
        } else {
            throw new WxException('V3密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getV3SerialNo(): string
    {
        return $this->v3SerialNo;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setV3SerialNo(string $v3SerialNo)
    {
        if (ctype_alnum($v3SerialNo)) {
            $this->v3SerialNo = $v3SerialNo;
        } else {
            throw new WxException('证书序列号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    public function getV3Algorithm(): string
    {
        return $this->v3Algorithm;
    }

    public function setV3Algorithm(string $v3Algorithm)
    {
        $this->v3Algorithm = $v3Algorithm;
    }

    public function getV3Nonce(): string
    {
        return $this->v3Nonce;
    }

    public function setV3Nonce(string $v3Nonce)
    {
        $this->v3Nonce = $v3Nonce;
    }

    public function getV3AssociatedData(): string
    {
        return $this->v3AssociatedData;
    }

    public function setV3AssociatedData(string $v3AssociatedData)
    {
        $this->v3AssociatedData = $v3AssociatedData;
    }

    public function getV3CipherText(): string
    {
        return $this->v3CipherText;
    }

    public function setV3CipherText(string $v3CipherText)
    {
        $this->v3CipherText = $v3CipherText;
    }

    public function getSslCompanyBank(): string
    {
        return $this->sslCompanyBank;
    }

    public function setSslCompanyBank(string $sslCompanyBank)
    {
        $this->sslCompanyBank = $sslCompanyBank;
    }

    public function getTemplates(): array
    {
        return $this->templates;
    }

    /**
     * @param string $templateTag 模板标识
     */
    public function getTemplateId(string $templateTag): string
    {
        return $this->templates[$templateTag] ?? '';
    }

    public function setTemplates(array $templates)
    {
        $this->templates = $templates;
    }

    public function getMerchantAppId(): string
    {
        return $this->merchantAppId;
    }

    /**
     * @throws \SyException\Wx\WxException
     */
    public function setMerchantAppId(string $merchantAppId)
    {
        $length = \strlen($merchantAppId);
        if ($length > 0) {
            if (18 != $length) {
                throw new WxException('服务商微信号不合法', ErrorCode::WX_PARAM_ERROR);
            }
            if (!ctype_alnum($merchantAppId)) {
                throw new WxException('服务商微信号不合法', ErrorCode::WX_PARAM_ERROR);
            }
        }
        $this->merchantAppId = $merchantAppId;
    }

    /**
     * 获取配置数组
     */
    public function getConfigs(): array
    {
        return [
            'appid' => $this->appId,
            'secret' => $this->secret,
            'clientip' => $this->clientIp,
            'pay.key' => $this->payKey,
            'pay.mchid' => $this->payMchId,
            'pay.url.auth' => $this->payAuthUrl,
            'pay.url.notify' => $this->payNotifyUrl,
            'ssl.key' => $this->sslKey,
            'ssl.cert' => $this->sslCert,
            'templates' => $this->templates,
            'valid' => $this->valid,
            'expire.time' => $this->expireTime,
        ];
    }
}
