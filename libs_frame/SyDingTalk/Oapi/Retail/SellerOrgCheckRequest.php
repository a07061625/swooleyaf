<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.retail.seller.org.check request
 * @author auto create
 * @since 1.0, 2019.10.31
 */
class SellerOrgCheckRequest extends BaseRequest
{
    /**
     * staffId
     **/
    private $userid;

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas["userid"] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.retail.seller.org.check";
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, "userid");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
