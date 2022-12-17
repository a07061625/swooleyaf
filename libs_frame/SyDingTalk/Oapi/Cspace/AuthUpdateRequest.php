<?php

namespace SyDingTalk\Oapi\Cspace;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.cspace.auth.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.08
 */
class AuthUpdateRequest extends BaseRequest
{
    /**
     * 微应用的agentId
     */
    private $agentId;
    /**
     * 授权码有效期，单位为日，为空则表示永久授权
     */
    private $duration;
    /**
     * isv授权码
     */
    private $isvCode;

    public function setAgentId($agentId)
    {
        $this->agentId = $agentId;
        $this->apiParas['agent_id'] = $agentId;
    }

    public function getAgentId()
    {
        return $this->agentId;
    }

    public function setDuration($duration)
    {
        $this->duration = $duration;
        $this->apiParas['duration'] = $duration;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setIsvCode($isvCode)
    {
        $this->isvCode = $isvCode;
        $this->apiParas['isv_code'] = $isvCode;
    }

    public function getIsvCode()
    {
        return $this->isvCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.cspace.auth.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->agentId, 'agentId');
        RequestCheckUtil::checkNotNull($this->isvCode, 'isvCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
