<?php

namespace SyAliPay\Ebpp\Recharge;

/**
 * ALIPAY API: alipay.ebpp.recharge.item.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019-03-08 15:29:11
 */
class ItemUpdateRequest
{
    /**
     * 测试
     */
    private $cardNo;
    /**
     * 是否销售
     */
    private $isForSale;
    /**
     * 货架id
     */
    private $itemCode;
    /**
     * 商品类型
     */
    private $itemCodeType;
    /**
     * 业务类型
     */
    private $orderType;
    private $apiParas = [];
    private $terminalType;
    private $terminalInfo;
    private $prodCode;
    private $apiVersion = '1.0';
    private $notifyUrl;
    private $returnUrl;
    private $needEncrypt = false;

    public function setCardNo($cardNo)
    {
        $this->cardNo = $cardNo;
        $this->apiParas['card_no'] = $cardNo;
    }

    public function getCardNo()
    {
        return $this->cardNo;
    }

    public function setIsForSale($isForSale)
    {
        $this->isForSale = $isForSale;
        $this->apiParas['is_for_sale'] = $isForSale;
    }

    public function getIsForSale()
    {
        return $this->isForSale;
    }

    public function setItemCode($itemCode)
    {
        $this->itemCode = $itemCode;
        $this->apiParas['item_code'] = $itemCode;
    }

    public function getItemCode()
    {
        return $this->itemCode;
    }

    public function setItemCodeType($itemCodeType)
    {
        $this->itemCodeType = $itemCodeType;
        $this->apiParas['item_code_type'] = $itemCodeType;
    }

    public function getItemCodeType()
    {
        return $this->itemCodeType;
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

    public function getApiMethodName()
    {
        return 'alipay.ebpp.recharge.item.update';
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
