<?php

namespace SyDingTalk\Oapi\Village;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.village.screen.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.28
 */
class ScreenGetRequest extends BaseRequest
{
    /**
     * -
     */
    private $req;

    public function setReq($req)
    {
        $this->req = $req;
        $this->apiParas['req'] = $req;
    }

    public function getReq()
    {
        return $this->req;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.village.screen.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
