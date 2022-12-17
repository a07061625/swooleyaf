<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.orders.inquiry request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.12
 */
class OrdersInquiryRequest extends BaseRequest
{
    /**
     * 询价企业id
     */
    private $corpid;
    /**
     * 订购周期数量
     */
    private $cycNum;
    /**
     * 订购周期单位
     */
    private $cycUnit;
    /**
     * 商品码
     */
    private $goodsCode;
    /**
     * 规格码
     */
    private $itemCode;
    /**
     * 询价用户手机号
     */
    private $mobile;
    /**
     * 订购人数
     */
    private $quantity;

    public function setCorpid($corpid)
    {
        $this->corpid = $corpid;
        $this->apiParas['corpid'] = $corpid;
    }

    public function getCorpid()
    {
        return $this->corpid;
    }

    public function setCycNum($cycNum)
    {
        $this->cycNum = $cycNum;
        $this->apiParas['cyc_num'] = $cycNum;
    }

    public function getCycNum()
    {
        return $this->cycNum;
    }

    public function setCycUnit($cycUnit)
    {
        $this->cycUnit = $cycUnit;
        $this->apiParas['cyc_unit'] = $cycUnit;
    }

    public function getCycUnit()
    {
        return $this->cycUnit;
    }

    public function setGoodsCode($goodsCode)
    {
        $this->goodsCode = $goodsCode;
        $this->apiParas['goods_code'] = $goodsCode;
    }

    public function getGoodsCode()
    {
        return $this->goodsCode;
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

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        $this->apiParas['quantity'] = $quantity;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.orders.inquiry';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpid, 'corpid');
        RequestCheckUtil::checkNotNull($this->cycNum, 'cycNum');
        RequestCheckUtil::checkNotNull($this->cycUnit, 'cycUnit');
        RequestCheckUtil::checkNotNull($this->goodsCode, 'goodsCode');
        RequestCheckUtil::checkNotNull($this->itemCode, 'itemCode');
        RequestCheckUtil::checkNotNull($this->mobile, 'mobile');
        RequestCheckUtil::checkNotNull($this->quantity, 'quantity');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
