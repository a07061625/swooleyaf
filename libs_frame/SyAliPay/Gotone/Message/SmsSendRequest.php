<?php

namespace SyAliPay\Gotone\Message;

/**
 * ALIPAY API: alipay.gotone.message.sms.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021-07-16 15:13:20
 */
class SmsSendRequest
{
    /**
     * 模板参数
     */
    private $arguments;
    /**
     * 接收短信手机号
     */
    private $mobile;
    /**
     * 短信模板对应的serviceCode
     */
    private $serviceCode;
    /**
     * 用户的支付宝ID
     */
    private $userId;
    private $apiParas = [];
    private $terminalType;
    private $terminalInfo;
    private $prodCode;
    private $apiVersion = '1.0';
    private $notifyUrl;
    private $returnUrl;
    private $needEncrypt = false;

    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
        $this->apiParas['arguments'] = $arguments;
    }

    public function getArguments()
    {
        return $this->arguments;
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
        $this->apiParas['service_code'] = $serviceCode;
    }

    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName()
    {
        return 'alipay.gotone.message.sms.send';
    }

    public function setNotifyUrl($notifyUrl)
    {
        $this->notifyUrl = $notifyUrl;
    }

    public function getNotifyUrl()
    {
        return $this->notifyUrl;
    }

    public function setReturnUrl($returnUrl)
    {
        $this->returnUrl = $returnUrl;
    }

    public function getReturnUrl()
    {
        return $this->returnUrl;
    }

    public function getApiParas()
    {
        return $this->apiParas;
    }

    public function getTerminalType()
    {
        return $this->terminalType;
    }

    public function setTerminalType($terminalType)
    {
        $this->terminalType = $terminalType;
    }

    public function getTerminalInfo()
    {
        return $this->terminalInfo;
    }

    public function setTerminalInfo($terminalInfo)
    {
        $this->terminalInfo = $terminalInfo;
    }

    public function getProdCode()
    {
        return $this->prodCode;
    }

    public function setProdCode($prodCode)
    {
        $this->prodCode = $prodCode;
    }

    public function setApiVersion($apiVersion)
    {
        $this->apiVersion = $apiVersion;
    }

    public function getApiVersion()
    {
        return $this->apiVersion;
    }

    public function setNeedEncrypt($needEncrypt)
    {
        $this->needEncrypt = $needEncrypt;
    }

    public function getNeedEncrypt()
    {
        return $this->needEncrypt;
    }
}
