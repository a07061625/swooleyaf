<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.circle.tag.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.06
 */
class CircleTagCreateRequest extends BaseRequest
{
    /**
     * 请求
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
        return 'dingtalk.oapi.workspace.circle.tag.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
