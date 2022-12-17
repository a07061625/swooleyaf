<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.orders.special_canal.create_order request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.12
 */
class OrdersSpecialCanalCreateOrderRequest extends BaseRequest
{
    /**
     * 下单企业id
     */
    private $corpid;
    /**
     * 订购周期数量
     */
    private $cycNum;
    /**
     * 订购的周期单位：1-年，2-月，3-日
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
     * 下单人手机号
     */
    private $mobile;
    /**
     * 联通订单id
     */
    private $orderCenterId;
    /**
     * 订购价格
     */
    private $price;
    /**
     * 订购数量
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

    public function setOrderCenterId($orderCenterId)
    {
        $this->orderCenterId = $orderCenterId;
        $this->apiParas['order_center_id'] = $orderCenterId;
    }

    public function getOrderCenterId()
    {
        return $this->orderCenterId;
    }

    public function setPrice($price)
    {
        $this->price = $price;
        $this->apiParas['price'] = $price;
    }

    public function getPrice()
    {
        return $this->price;
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
        return 'dingtalk.oapi.appstore.orders.special_canal.create_order';
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
        RequestCheckUtil::checkNotNull($this->orderCenterId, 'orderCenterId');
        RequestCheckUtil::checkNotNull($this->price, 'price');
        RequestCheckUtil::checkNotNull($this->quantity, 'quantity');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
