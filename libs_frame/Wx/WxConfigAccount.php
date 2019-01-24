<?php
/**
 * 微信商户平台配置类
 * User: 姜伟
 * Date: 2017/6/13 0013
 * Time: 19:01
 */
namespace Wx;

use Constant\ErrorCode;
use Exception\Wx\WxException;
use Tool\Tool;

class WxConfigAccount {
    /**
     * 客户端IP
     * @var string
     */
    private $clientIp = '';

    /**
     * 微信号
     * @var string
     */
    private $appId = '';

    /**
     * 微信随机密钥
     * @var string
     */
    private $secret = '';

    /**
     * 商户号
     * @var string
     */
    private $payMchId = '';

    /**
     * 商户支付密钥
     * @var string
     */
    private $payKey = '';

    /**
     * 支付异步通知URL
     * @var string
     */
    private $payNotifyUrl = '';

    /**
     * 支付授权URL
     * @var string
     */
    private $payAuthUrl = '';

    /**
     * CERT PEM证书路径
     * @var string
     */
    private $sslCert = '';

    /**
     * KEY PEM证书路径
     * @var string
     */
    private $sslKey = '';

    /**
     * 模板列表
     * @var array
     */
    private $templates = [];

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
    public function getClientIp(): string {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     * @throws \Exception\WX\WxException
     */
    public function setClientIp(string $clientIp) {
        if(preg_match('/^(\.(\d|[1-9]\d|1\d{2}|2[0-4]\d|25[0-5])){4}$/', '.' . $clientIp) > 0){
            $this->clientIp = $clientIp;
        } else {
            throw new WxException('客户端IP不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getAppId(): string {
        return $this->appId;
    }

    /**
     * @param string $appId
     * @throws \Exception\WX\WxException
     */
    public function setAppId(string $appId) {
        if(ctype_alnum($appId) && (strlen($appId) == 18)){
            $this->appId = $appId;
        } else {
            throw new WxException('app id不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSecret(): string {
        return $this->secret;
    }

    /**
     * @param string $secret
     * @throws \Exception\WX\WxException
     */
    public function setSecret(string $secret) {
        if(ctype_alnum($secret) && (strlen($secret) == 32)){
            $this->secret = $secret;
        } else {
            throw new WxException('secret不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPayMchId(): string {
        return $this->payMchId;
    }

    /**
     * @param string $payMchId
     * @throws \Exception\WX\WxException
     */
    public function setPayMchId(string $payMchId) {
        if(ctype_digit($payMchId)){
            $this->payMchId = $payMchId;
        } else {
            throw new WxException('商户号不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPayKey(): string {
        return $this->payKey;
    }

    /**
     * @param string $payKey
     * @throws \Exception\WX\WxException
     */
    public function setPayKey(string $payKey) {
        if(ctype_alnum($payKey) && (strlen($payKey) == 32)){
            $this->payKey = $payKey;
        } else {
            throw new WxException('支付密钥不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPayNotifyUrl(): string {
        return $this->payNotifyUrl;
    }

    /**
     * @param string $payNotifyUrl
     * @throws \Exception\WX\WxException
     */
    public function setPayNotifyUrl(string $payNotifyUrl) {
        if(preg_match('/^(http|https)\:\/\/\S+$/', $payNotifyUrl) > 0){
            $this->payNotifyUrl = $payNotifyUrl;
        } else {
            throw new WxException('支付异步消息通知URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getPayAuthUrl(): string {
        return $this->payAuthUrl;
    }

    /**
     * @param string $payAuthUrl
     * @throws \Exception\WX\WxException
     */
    public function setPayAuthUrl(string $payAuthUrl) {
        if(preg_match('/^(http|https)\:\/\/\S+$/', $payAuthUrl) > 0){
            $this->payAuthUrl = $payAuthUrl;
        } else {
            throw new WxException('支付授权URL不合法', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSslCert(): string {
        return $this->sslCert;
    }

    /**
     * @param string $sslCert
     * @throws \Exception\WX\WxException
     */
    public function setSslCert(string $sslCert) {
        if(strlen($sslCert) > 0){
            $this->sslCert = $sslCert;
        } else {
            throw new WxException('cert证书不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getSslKey(): string {
        return $this->sslKey;
    }

    /**
     * @param string $sslKey
     * @throws \Exception\WX\WxException
     */
    public function setSslKey(string $sslKey) {
        if(strlen($sslKey) > 0){
            $this->sslKey = $sslKey;
        } else {
            throw new WxException('key证书不能为空', ErrorCode::WX_PARAM_ERROR);
        }
    }

    /**
     * @return array
     */
    public function getTemplates() : array {
        return $this->templates;
    }

    /**
     * @param string $templateTag 模板标识
     * @return string
     */
    public function getTemplateId(string $templateTag) : string {
        return $this->templates[$templateTag] ?? '';
    }

    /**
     * @param array $templates
     */
    public function setTemplates(array $templates) {
        $this->templates = $templates;
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
    public function setValid(bool $valid){
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
    public function setExpireTime(int $expireTime){
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