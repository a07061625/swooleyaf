<?php

namespace SyDingTalk\Oapi\Inspect;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.inspect.task.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.11
 */
class TaskListRequest extends BaseRequest
{
    /**
     * 请求入参
     */
    private $param;

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.inspect.task.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
