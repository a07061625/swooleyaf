<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:02
 */

namespace AliPay;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\AliPay\AliPayPayException;
use SyTool\Tool;
use SyTrait\SimpleConfigTrait;

class PayConfig
{
    use SimpleConfigTrait;

    /**
     * AppId
     *
     * @var string
     */
    private $appId = '';

    /**
     * 卖家ID
     *
     * @var string
     */
    private $sellerId = '';

    /**
     * 异步消息通知URL
     *
     * @var string
     */
    private $urlNotify = '';

    /**
     * 同步消息通知URL
     *
     * @var string
     */
    private $urlReturn = '';

    /**
     * rsa私钥
     *
     * @var string
     */
    private $priRsaKey = '';

    /**
     * 完整rsa私钥
     *
     * @var string
     */
    private $priRsaKeyFull = '';

    /**
     * rsa公钥
     *
     * @var string
     */
    private $pubRsaKey = '';

    /**
     * 支付宝公钥
     *
     * @var string
     */
    private $pubAliKey = '';

    /**
     * 完整支付宝公钥
     *
     * @var string
     */
    private $pubAliKeyFull = '';

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __toString()
    {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    public function getAppId(): string
    {
        return $this->appId;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setAppId(string $appId)
    {
        if (ctype_digit($appId) && (16 == \strlen($appId))) {
            $this->appId = $appId;
        } else {
            throw new AliPayPayException('app id不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setSellerId(string $sellerId)
    {
        if (ctype_digit($sellerId) && (16 == \strlen($sellerId)) && ('2088' == substr($sellerId, 0, 4))) {
            $this->sellerId = $sellerId;
        } else {
            throw new AliPayPayException('卖家ID不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getUrlNotify(): string
    {
        return $this->urlNotify;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setUrlNotify(string $urlNotify)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlNotify) > 0) {
            $this->urlNotify = $urlNotify;
        } else {
            throw new AliPayPayException('异步消息通知URL不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getUrlReturn(): string
    {
        return $this->urlReturn;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setUrlReturn(string $urlReturn)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $urlReturn) > 0) {
            $this->urlReturn = $urlReturn;
        } else {
            throw new AliPayPayException('同步消息通知URL不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getPriRsaKey(): string
    {
        return $this->priRsaKey;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setPriRsaKey(string $priRsaKey)
    {
        if (\strlen($priRsaKey) >= 1024) {
            $this->priRsaKey = $priRsaKey;
            $this->priRsaKeyFull = '-----BEGIN RSA PRIVATE KEY-----' . PHP_EOL . wordwrap($priRsaKey, 64, "\n", true) . PHP_EOL . '-----END RSA PRIVATE KEY-----';
        } else {
            throw new AliPayPayException('rsa私钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getPriRsaKeyFull(): string
    {
        return $this->priRsaKeyFull;
    }

    public function getPubRsaKey(): string
    {
        return $this->pubRsaKey;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setPubRsaKey(string $pubRsaKey)
    {
        if (\strlen($pubRsaKey) >= 256) {
            $this->pubRsaKey = $pubRsaKey;
        } else {
            throw new AliPayPayException('rsa公钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getPubAliKey(): string
    {
        return $this->pubAliKey;
    }

    /**
     * @throws \SyException\AliPay\AliPayPayException
     */
    public function setPubAliKey(string $pubAliKey)
    {
        if (\strlen($pubAliKey) >= 256) {
            $this->pubAliKey = $pubAliKey;
            $this->pubAliKeyFull = '-----BEGIN PUBLIC KEY-----' . PHP_EOL . wordwrap($pubAliKey, 64, "\n", true) . PHP_EOL . '-----END PUBLIC KEY-----';
        } else {
            throw new AliPayPayException('支付宝公钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    public function getPubAliKeyFull(): string
    {
        return $this->pubAliKeyFull;
    }

    /**
     * 获取配置数组
     */
    public function getConfigs(): array
    {
        return [
            'appid' => $this->appId,
            'seller.id' => $this->sellerId,
            'url.notify' => $this->urlNotify,
            'url.return' => $this->urlReturn,
            'prikey.rsa' => $this->priRsaKey,
            'pubkey.rsa' => $this->pubRsaKey,
            'pubkey.alipay' => $this->pubAliKey,
            'valid' => $this->valid,
            'expire.time' => $this->expireTime,
        ];
    }
}
