<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:38
 */
namespace SyPay;

use SyConstant\ErrorCode;
use SyException\Pay\PayPalException;

/**
 * Class ConfigPayPal
 *
 * @package SyPay
 */
class ConfigPayPal
{
    /**
     * 客户端ID
     *
     * @var string
     */
    private $clientId = '';
    /**
     * 客户端密钥
     *
     * @var string
     */
    private $clientSecret = '';
    /**
     * 支付成功回调地址
     *
     * @var string
     */
    private $returnUrl = '';
    /**
     * 支付取消回调地址
     *
     * @var string
     */
    private $cancelUrl = '';
    /**
     * 支付异步通知网页ID,用于异步通知验签
     *
     * @var string
     */
    private $notifyWebHookId = '';
    /**
     * 配置有效状态
     *
     * @var bool
     */
    private $valid = false;

    /**
     * 配置过期时间戳
     *
     * @var int
     */
    private $expireTime = 0;

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    /**
     * @return string
     */
    public function getClientId() : string
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function setClientId(string $clientId)
    {
        $trueId = trim($clientId);
        if (strlen($trueId) > 0) {
            $this->clientId = $trueId;
        } else {
            throw new PayPalException('客户端ID不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getClientSecret() : string
    {
        return $this->clientSecret;
    }

    /**
     * @param string $clientSecret
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function setClientSecret(string $clientSecret)
    {
        $trueSecret = trim($clientSecret);
        if (strlen($trueSecret) > 0) {
            $this->clientSecret = $trueSecret;
        } else {
            throw new PayPalException('客户端密钥不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getReturnUrl() : string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function setReturnUrl(string $returnUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $returnUrl) > 0) {
            $this->returnUrl = $returnUrl;
        } else {
            throw new PayPalException('支付成功回调地址不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getCancelUrl() : string
    {
        return $this->cancelUrl;
    }

    /**
     * @param string $cancelUrl
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function setCancelUrl(string $cancelUrl)
    {
        if (preg_match('/^(http|https)\:\/\/\S+$/', $cancelUrl) > 0) {
            $this->cancelUrl = $cancelUrl;
        } else {
            throw new PayPalException('支付取消回调地址不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * @return string
     */
    public function getNotifyWebHookId() : string
    {
        return $this->notifyWebHookId;
    }

    /**
     * @param string $notifyWebHookId
     *
     * @throws \SyException\Pay\PayPalException
     */
    public function setNotifyWebHookId(string $notifyWebHookId)
    {
        $trueId = trim($notifyWebHookId);
        if (strlen($trueId) > 0) {
            $this->notifyWebHookId = $trueId;
        } else {
            throw new PayPalException('支付异步通知网页ID不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    /**
     * @return bool
     */
    public function isValid() : bool
    {
        return $this->valid;
    }

    /**
     * @param bool $valid
     */
    public function setValid(bool $valid)
    {
        $this->valid = $valid;
    }

    /**
     * @return int
     */
    public function getExpireTime() : int
    {
        return $this->expireTime;
    }

    /**
     * @param int $expireTime
     */
    public function setExpireTime(int $expireTime)
    {
        $this->expireTime = $expireTime;
    }
}
