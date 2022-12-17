<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.workrecord.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.10
 */
class WorkRecordDeleteRequest extends BaseRequest
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
        return 'dingtalk.oapi.process.workrecord.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
