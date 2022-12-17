<?php

namespace SyDingTalk\Oapi\AliTrip;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.alitrip.btrip.bind.taobao.get request
 * @author auto create
 * @since 1.0, 2020.02.19
 */
class BtripBindTaobaoGetRequest extends BaseRequest
{
    /**
     * 请求对象
     **/
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas["request"] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.alitrip.btrip.bind.taobao.get";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
