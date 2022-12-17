<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class DeleteRequest extends BaseRequest
{
    /**
     * 微应用实例化id，企业只能删除自建微应用
     */
    private $agentId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agentId'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
