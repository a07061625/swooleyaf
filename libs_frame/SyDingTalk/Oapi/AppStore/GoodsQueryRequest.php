<?php

namespace SyDingTalk\Oapi\AppStore;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.appstore.goods.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.12
 */
class GoodsQueryRequest extends BaseRequest
{
    /**
     * 商品码
     */
    private $goodsCode;

    public function setGoodsCode($goodsCode)
    {
        $this->goodsCode = $goodsCode;
        $this->apiParas['goods_code'] = $goodsCode;
    }

    public function getGoodsCode()
    {
        return $this->goodsCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.appstore.goods.query';
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
