<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.cspace.get_custom_space request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetCustomSpaceRequest extends BaseRequest
{
    /**
     * ISV调用时传入，微应用agentId
     */
    private $agentId;
    /**
     * 企业调用时传入，需要为10个字节以内的字符串，仅可包含字母和数字，大小写不敏感
     */
    private $domain;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setDomain($domain)
    {
        $this->domain = $domain;
        $this->apiParas['domain'] = $domain;
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.cspace.get_custom_space';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
