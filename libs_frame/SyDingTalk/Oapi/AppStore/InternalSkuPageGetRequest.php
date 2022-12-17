<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.internal.skupage.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class InternalSkuPageGetRequest extends BaseRequest
{
    /**
     * 回调页面(进行URLEncode处理)，微应用为页面URL，E应用为页面路径地址
     */
    private $callbackPage;
    /**
     * 与callbackPage配合使用。当用户从SKU页面下单并支付成功后，会跳转回ISV页面，此时将此参数原样回传。主要用于用户页面引导等操作，不能作为权益开通凭证。
     */
    private $extendParam;
    /**
     * 内购商品码
     */
    private $goodsCode;
    /**
     * 内购商品规格码，如果设置了规格码，页面会默认选中该规格码
     */
    private $itemCode;

    public function setCallbackPage($callbackPage)
    {
        $this->callbackPage = $callbackPage;
        $this->apiParas['callback_page'] = $callbackPage;
    }

    public function getCallbackPage()
    {
        return $this->callbackPage;
    }

    public function setExtendParam($extendParam)
    {
        $this->extendParam = $extendParam;
        $this->apiParas['extend_param'] = $extendParam;
    }

    public function getExtendParam()
    {
        return $this->extendParam;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.internal.skupage.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->goodsCode, 'goodsCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
