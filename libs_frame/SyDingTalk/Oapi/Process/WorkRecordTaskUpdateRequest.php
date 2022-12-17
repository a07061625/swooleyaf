<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.workrecord.task.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class WorkRecordTaskUpdateRequest extends BaseRequest
{
    /**
     * 请求
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
        return 'dingtalk.oapi.process.workrecord.task.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
