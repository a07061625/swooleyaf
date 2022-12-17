<?php

namespace SyDingTalk\Oapi\Calendar;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.calendar.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.20
 */
class DeleteRequest extends BaseRequest
{
    /**
     * 日程id
     */
    private $calendarId;
    /**
     * 员工id
     */
    private $userid;

    public function setCalendarId($calendarId)
    {
        $this->calendarId = $calendarId;
        $this->apiParas['calendar_id'] = $calendarId;
    }

    public function getCalendarId()
    {
        return $this->calendarId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.calendar.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
