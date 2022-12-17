<?php

namespace SyDingTalk\Oapi\OrgPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.orgpaas.org.info.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class OrgInfoGetRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.orgpaas.org.info.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
