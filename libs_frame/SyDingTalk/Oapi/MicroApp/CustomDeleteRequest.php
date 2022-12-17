<?php

namespace SyDingTalk\Oapi\MicroApp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.microapp.custom.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.11
 */
class CustomDeleteRequest extends BaseRequest
{
    /**
     * 定制应用id
     */
    private $agentId;
    /**
     * 定制应用所属企业
     */
    private $appCorpId;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setAppCorpId($appCorpId)
    {
        $this->appCorpId = $appCorpId;
        $this->apiParas['app_corp_id'] = $appCorpId;
    }

    public function getAppCorpId()
    {
        return $this->appCorpId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.microapp.custom.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
