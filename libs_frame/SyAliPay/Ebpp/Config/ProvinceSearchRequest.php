<?php

namespace SyAliPay\Ebpp\Config;

/**
 * ALIPAY API: alipay.ebpp.config.province.search request
 *
 * @author auto create
 *
 * @since 1.0, 2021-07-13 15:43:56
 */
class ProvinceSearchRequest
{
    /**
     * 业务类型
     */
    private $orderType;
    /**
     * 子业务类型
     */
    private $subOrderType;
    private $apiParas = [];
    private $terminalType;
    private $terminalInfo;
    private $prodCode;
    private $apiVersion = '1.0';
    private $notifyUrl;
    private $returnUrl;
    private $needEncrypt = false;

    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
        $this->apiParas['order_type'] = $orderType;
    }

    public function getOrderType()
    {
        return $this->orderType;
    }

    public function setSubOrderType($subOrderType)
    {
        $this->subOrderType = $subOrderType;
        $this->apiParas['sub_order_type'] = $subOrderType;
    }

    public function getSubOrderType()
    {
        return $this->subOrderType;
    }

    public function getApiMethodName()
    {
        return 'alipay.ebpp.config.province.search';
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
