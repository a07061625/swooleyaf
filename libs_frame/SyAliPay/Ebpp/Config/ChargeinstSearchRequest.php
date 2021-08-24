<?php

namespace SyAliPay\Ebpp\Config;

/**
 * ALIPAY API: alipay.ebpp.config.chargeinst.search request
 *
 * @author auto create
 *
 * @since 1.0, 2021-07-14 10:13:19
 */
class ChargeinstSearchRequest
{
    /**
     * 城市
     */
    private $city;
    /**
     * 业务类型
     */
    private $orderType;
    /**
     * 省份
     */
    private $province;
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

    public function setCity($city)
    {
        $this->city = $city;
        $this->apiParas['city'] = $city;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
        $this->apiParas['order_type'] = $orderType;
    }

    public function getOrderType()
    {
        return $this->orderType;
    }

    public function setProvince($province)
    {
        $this->province = $province;
        $this->apiParas['province'] = $province;
    }

    public function getProvince()
    {
        return $this->province;
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
        return 'alipay.ebpp.config.chargeinst.search';
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
