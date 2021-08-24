<?php

namespace SyAliPay\Gotone\Message;

/**
 * ALIPAY API: alipay.gotone.message.mail.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021-07-14 10:13:51
 */
class MailSendRequest
{
    /**
     * 模板参数
     */
    private $arguments;
    /**
     * 收件人邮箱地址
     */
    private $receiver;
    /**
     * 邮件模板对应的serviceCode
     */
    private $serviceCode;
    /**
     * 邮件标题
     */
    private $subject;
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

    public function setReceiver($receiver)
    {
        $this->receiver = $receiver;
        $this->apiParas['receiver'] = $receiver;
    }

    public function getReceiver()
    {
        return $this->receiver;
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

    public function setSubject($subject)
    {
        $this->subject = $subject;
        $this->apiParas['subject'] = $subject;
    }

    public function getSubject()
    {
        return $this->subject;
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
        return 'alipay.gotone.message.mail.send';
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
