<?php

namespace SyDingTalk\Oapi\Live;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.live.grouplive.listbytime request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.23
 */
class GroupLiveListByTimeRequest extends BaseRequest
{
    /**
     * 查询直播参数
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
        return 'dingtalk.oapi.live.grouplive.listbytime';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
