<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.detail.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.30
 */
class GroupLiveDetailGetRequest extends BaseRequest
{
    /**
     * 群直播详情请求
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
        return 'dingtalk.oapi.live.grouplive.detail.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
