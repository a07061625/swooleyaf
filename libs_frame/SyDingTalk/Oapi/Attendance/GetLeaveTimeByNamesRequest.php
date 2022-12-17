<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.getleavetimebynames request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.21
 */
class GetLeaveTimeByNamesRequest extends BaseRequest
{
    /**
     * 开始时间
     */
    private $fromDate;
    /**
     * 假期名称
     */
    private $leaveNames;
    /**
     * 结束时间
     */
    private $toDate;
    /**
     * 用户的userId
     */
    private $userid;

    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;
        $this->apiParas['from_date'] = $fromDate;
    }

    public function getFromDate()
    {
        return $this->fromDate;
    }

    public function setLeaveNames($leaveNames)
    {
        $this->leaveNames = $leaveNames;
        $this->apiParas['leave_names'] = $leaveNames;
    }

    public function getLeaveNames()
    {
        return $this->leaveNames;
    }

    public function setToDate($toDate)
    {
        $this->toDate = $toDate;
        $this->apiParas['to_date'] = $toDate;
    }

    public function getToDate()
    {
        return $this->toDate;
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
        return 'dingtalk.oapi.attendance.getleavetimebynames';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->leaveNames, 20, 'leaveNames');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
