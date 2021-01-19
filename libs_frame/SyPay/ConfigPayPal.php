<?php
/**
 * Created by PhpStorm.
 * User: 姜伟
 * Date: 2020/8/12 0012
 * Time: 13:38
 */

namespace SyPay;

use SyConstant\ErrorCode;
use SyConstant\ProjectBase;
use SyException\Pay\PayPalException;
use SyTrait\SimpleConfigTrait;

/**
 * Class ConfigPayPal
 *
 * @package SyPay
 */
class ConfigPayPal
{
    use SimpleConfigTrait;

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

    public function __construct()
    {
    }

    private function __clone()
    {
    }

    public function getClientId(): string
    {
        return $this->clientId;
    }

    /**
     * @throws \SyException\Pay\PayPalException
     */
    public function setClientId(string $clientId)
    {
        $trueId = trim($clientId);
        if (\strlen($trueId) > 0) {
            $this->clientId = $trueId;
        } else {
            throw new PayPalException('客户端ID不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    public function getClientSecret(): string
    {
        return $this->clientSecret;
    }

    /**
     * @throws \SyException\Pay\PayPalException
     */
    public function setClientSecret(string $clientSecret)
    {
        $trueSecret = trim($clientSecret);
        if (\strlen($trueSecret) > 0) {
            $this->clientSecret = $trueSecret;
        } else {
            throw new PayPalException('客户端密钥不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * @throws \SyException\Pay\PayPalException
     */
    public function setReturnUrl(string $returnUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $returnUrl) > 0) {
            $this->returnUrl = $returnUrl;
        } else {
            throw new PayPalException('支付成功回调地址不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    public function getCancelUrl(): string
    {
        return $this->cancelUrl;
    }

    /**
     * @throws \SyException\Pay\PayPalException
     */
    public function setCancelUrl(string $cancelUrl)
    {
        if (preg_match(ProjectBase::REGEX_URL_HTTP, $cancelUrl) > 0) {
            $this->cancelUrl = $cancelUrl;
        } else {
            throw new PayPalException('支付取消回调地址不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }

    public function getNotifyWebHookId(): string
    {
        return $this->notifyWebHookId;
    }

    /**
     * @throws \SyException\Pay\PayPalException
     */
    public function setNotifyWebHookId(string $notifyWebHookId)
    {
        $trueId = trim($notifyWebHookId);
        if (\strlen($trueId) > 0) {
            $this->notifyWebHookId = $trueId;
        } else {
            throw new PayPalException('支付异步通知网页ID不合法', ErrorCode::PAY_PAYPAL_PARAM_ERROR);
        }
    }
}
