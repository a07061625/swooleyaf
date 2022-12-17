<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.meetingroom.checkin request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.05
 */
class MeetingRoomCheckinRequest extends BaseRequest
{
    /**
     * 预约会议ID
     */
    private $bookid;
    /**
     * 签到用户ID
     */
    private $userid;

    public function setBookid($bookid)
    {
        $this->bookid = $bookid;
        $this->apiParas['bookid'] = $bookid;
    }

    public function getBookid()
    {
        return $this->bookid;
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
        return 'dingtalk.oapi.smartdevice.meetingroom.checkin';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bookid, 'bookid');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
