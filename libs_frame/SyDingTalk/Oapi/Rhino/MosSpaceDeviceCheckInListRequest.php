<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.mos.space.device.check.in.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.07
 */
class MosSpaceDeviceCheckInListRequest extends BaseRequest
{
    /**
     * request
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
        return 'dingtalk.oapi.rhino.mos.space.device.check.in.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
