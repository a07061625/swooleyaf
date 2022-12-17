<?php

namespace SyDingTalk\Corp\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.smartdevice.receptionist.pushinfo request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ReceptionistPushInfoRequest extends BaseRequest
{
    /**
     * 展示模板需要的变量数据
     */
    private $descContent;
    /**
     * 智能前台信息展示模板ID，需要向智能硬件团队申请
     */
    private $descTemplate;
    /**
     * 微应用agentID
     */
    private $microappAgentId;

    public function setDescContent($descContent)
    {
        $this->descContent = $descContent;
        $this->apiParas['desc_content'] = $descContent;
    }

    public function getDescContent()
    {
        return $this->descContent;
    }

    public function setDescTemplate($descTemplate)
    {
        $this->descTemplate = $descTemplate;
        $this->apiParas['desc_template'] = $descTemplate;
    }

    public function getDescTemplate()
    {
        return $this->descTemplate;
    }

    public function setMicroappAgentId($microappAgentId)
    {
        $this->microappAgentId = $microappAgentId;
        $this->apiParas['microapp_agent_id'] = $microappAgentId;
    }

    public function getMicroappAgentId()
    {
        return $this->microappAgentId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.smartdevice.receptionist.pushinfo';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->descContent, 'descContent');
        RequestCheckUtil::checkNotNull($this->descTemplate, 'descTemplate');
        RequestCheckUtil::checkNotNull($this->microappAgentId, 'microappAgentId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
