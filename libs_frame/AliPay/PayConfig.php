<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2018/9/6 0006
 * Time: 14:02
 */
namespace AliPay;

use Constant\ErrorCode;
use Exception\AliPay\AliPayPayException;
use Tool\Tool;

class PayConfig {
    /**
     * AppId
     * @var string
     */
    private $appId = '';

    /**
     * 卖家ID
     * @var string
     */
    private $sellerId = '';

    /**
     * 异步消息通知URL
     * @var string
     */
    private $urlNotify = '';

    /**
     * 同步消息通知URL
     * @var string
     */
    private $urlReturn = '';

    /**
     * rsa私钥
     * @var string
     */
    private $priRsaKey = '';

    /**
     * 完整rsa私钥
     * @var string
     */
    private $priRsaKeyFull = '';

    /**
     * rsa公钥
     * @var string
     */
    private $pubRsaKey = '';

    /**
     * 支付宝公钥
     * @var string
     */
    private $pubAliKey = '';

    /**
     * 完整支付宝公钥
     * @var string
     */
    private $pubAliKeyFull = '';

    /**
     * 配置有效状态
     * @var bool
     */
    private $valid = false;

    /**
     * 配置过期时间戳
     * @var int
     */
    private $expireTime = 0;

    public function __construct() {
    }

    private function __clone() {
    }

    /**
     * @return string
     */
    public function getAppId() : string {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setAppId(string $appId) {
        if(ctype_digit($appId) && (strlen($appId) == 16)){
            $this->appId = $appId;
        } else {
            throw new AliPayPayException('app id不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSellerId(): string {
        return $this->sellerId;
    }

    /**
     * @param string $sellerId
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setSellerId(string $sellerId) {
        if(ctype_digit($sellerId) && (strlen($sellerId) == 16) && (substr($sellerId, 0, 4) == '2088')){
            $this->sellerId = $sellerId;
        } else {
            throw new AliPayPayException('卖家ID不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUrlNotify(): string {
        return $this->urlNotify;
    }

    /**
     * @param string $urlNotify
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setUrlNotify(string $urlNotify) {
        if(preg_match('/^(http|https)\:\/\/\S+$/', $urlNotify) > 0){
            $this->urlNotify = $urlNotify;
        } else {
            throw new AliPayPayException('异步消息通知URL不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getUrlReturn(): string {
        return $this->urlReturn;
    }

    /**
     * @param string $urlReturn
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setUrlReturn(string $urlReturn) {
        if(preg_match('/^(http|https)\:\/\/\S+$/', $urlReturn) > 0){
            $this->urlReturn = $urlReturn;
        } else {
            throw new AliPayPayException('同步消息通知URL不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPriRsaKey(): string {
        return $this->priRsaKey;
    }

    /**
     * @param string $priRsaKey
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setPriRsaKey(string $priRsaKey) {
        if(strlen($priRsaKey) >= 1024){
            $this->priRsaKey = $priRsaKey;
            $this->priRsaKeyFull = "-----BEGIN RSA PRIVATE KEY-----" . PHP_EOL . wordwrap($priRsaKey, 64, "\n", true) . PHP_EOL . "-----END RSA PRIVATE KEY-----";
        } else {
            throw new AliPayPayException('rsa私钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPriRsaKeyFull() : string {
        return $this->priRsaKeyFull;
    }

    /**
     * @return string
     */
    public function getPubRsaKey(): string {
        return $this->pubRsaKey;
    }

    /**
     * @param string $pubRsaKey
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setPubRsaKey(string $pubRsaKey) {
        if(strlen($pubRsaKey) >= 256){
            $this->pubRsaKey = $pubRsaKey;
        } else {
            throw new AliPayPayException('rsa公钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPubAliKey(): string {
        return $this->pubAliKey;
    }

    /**
     * @param string $pubAliKey
     * @throws \Exception\AliPay\AliPayPayException
     */
    public function setPubAliKey(string $pubAliKey) {
        if(strlen($pubAliKey) >= 256){
            $this->pubAliKey = $pubAliKey;
            $this->pubAliKeyFull = "-----BEGIN PUBLIC KEY-----" . PHP_EOL . wordwrap($pubAliKey, 64, "\n", true) . PHP_EOL . "-----END PUBLIC KEY-----";
        } else {
            throw new AliPayPayException('支付宝公钥不合法', ErrorCode::ALIPAY_PAY_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPubAliKeyFull() : string {
        return $this->pubAliKeyFull;
    }

    /**
     * @return bool
     */
    public function isValid() : bool {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid) {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime) {
        $this->expireTime = $expireTime;
    }

    public function __toString() {
        return Tool::jsonEncode($this->getConfigs(), JSON_UNESCAPED_UNICODE);
    }

    /**
     * 获取配置数组
     * @return array
     */
    public function getConfigs() : array {
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