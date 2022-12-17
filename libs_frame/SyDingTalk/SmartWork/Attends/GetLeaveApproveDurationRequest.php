<?php

namespace SyDingTalk\SmartWork\Attends;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.attends.getleaveapproveduration request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetLeaveApproveDurationRequest extends BaseRequest
{
    /**
     * 请假开始时间
     */
    private $fromDate;
    /**
     * 请假结束时间
     */
    private $toDate;
    /**
     * 员工在企业内的UserID，企业用来唯一标识用户的字段。
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
        return 'dingtalk.smartwork.attends.getleaveapproveduration';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->fromDate, 'fromDate');
        RequestCheckUtil::checkNotNull($this->toDate, 'toDate');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
