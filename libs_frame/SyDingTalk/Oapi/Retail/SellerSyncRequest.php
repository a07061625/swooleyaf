<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.retail.seller.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.03
 */
class SellerSyncRequest extends BaseRequest
{
    /**
     * 卖家信息
     */
    private $sellerParam;
    /**
     * staffId
     */
    private $userid;

    public function setSellerParam($sellerParam)
    {
        $this->sellerParam = $sellerParam;
        $this->apiParas['seller_param'] = $sellerParam;
    }

    public function getSellerParam()
    {
        return $this->sellerParam;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.retail.seller.sync';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
