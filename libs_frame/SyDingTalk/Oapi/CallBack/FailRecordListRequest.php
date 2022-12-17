<?php

namespace SyDingTalk\Oapi\CallBack;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.callback.failrecord.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FailRecordListRequest extends BaseRequest
{
    /**
     * 请求参数
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
        return 'dingtalk.oapi.callback.failrecord.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
