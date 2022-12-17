<?php

namespace SyDingTalk\Oapi\Calendar;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.calendar.v2.event.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.16
 */
class V2EventUpdateRequest extends BaseRequest
{
    /**
     * 开放平台应用对应的AgentId
     */
    private $agentid;
    /**
     * 日程创建对象
     */
    private $event;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setEvent($event)
    {
        $this->event = $event;
        $this->apiParas['event'] = $event;
    }

    public function getEvent()
    {
        return $this->event;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.calendar.v2.event.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
