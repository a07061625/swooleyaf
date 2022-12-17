<?php

namespace SyDingTalk\Oapi\Calendar;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.calendar.v2.event.detail request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.16
 */
class V2EventDetailRequest extends BaseRequest
{
    /**
     * 开放平台应用对应的AgentId
     */
    private $agentid;
    /**
     * 日历ID,目前仅支持传primary,表示修改当前用户“我的日程”下的日程
     */
    private $calendarId;
    /**
     * 日程Id
     */
    private $eventId;

    public function setAgentid($agentid)
    {
        $this->agentid = $agentid;
        $this->apiParas['agentid'] = $agentid;
    }

    public function getAgentid()
    {
        return $this->agentid;
    }

    public function setCalendarId($calendarId)
    {
        $this->calendarId = $calendarId;
        $this->apiParas['calendar_id'] = $calendarId;
    }

    public function getCalendarId()
    {
        return $this->calendarId;
    }

    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
        $this->apiParas['event_id'] = $eventId;
    }

    public function getEventId()
    {
        return $this->eventId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.calendar.v2.event.detail';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->calendarId, 'calendarId');
        RequestCheckUtil::checkMaxLength($this->calendarId, 64, 'calendarId');
        RequestCheckUtil::checkNotNull($this->eventId, 'eventId');
        RequestCheckUtil::checkMaxLength($this->eventId, 64, 'eventId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
