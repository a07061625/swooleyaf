<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.querypayrelatedtemplate request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class QueryPayRelatedTemplateRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.process.querypayrelatedtemplate';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
