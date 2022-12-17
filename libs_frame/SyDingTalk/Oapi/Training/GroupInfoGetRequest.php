<?php

namespace SyDingTalk\Oapi\Training;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.training.groupinfo.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.24
 */
class GroupInfoGetRequest extends BaseRequest
{
    /**
     * 系统自动生成
     */
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas['request'] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.training.groupinfo.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
