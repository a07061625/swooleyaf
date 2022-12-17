<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.getAttendUpdateData request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class GetAttendUpdateDataRequest extends BaseRequest
{
    /**
     * 用户id
     */
    private $userid;
    /**
     * 工作日
     */
    private $workDate;

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function setWorkDate($workDate)
    {
        $this->workDate = $workDate;
        $this->apiParas['work_date'] = $workDate;
    }

    public function getWorkDate()
    {
        return $this->workDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.getAttendUpdateData';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
        RequestCheckUtil::checkNotNull($this->workDate, 'workDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
