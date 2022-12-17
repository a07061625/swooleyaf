<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.schedule.shift.listbydays request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.06
 */
class ScheduleShiftListByDaysRequest extends BaseRequest
{
    /**
     * 开始日期
     */
    private $fromDateTime;
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 结束日期
     */
    private $toDateTime;
    /**
     * 人员userIds
     */
    private $userids;

    public function setFromDateTime($fromDateTime)
    {
        $this->fromDateTime = $fromDateTime;
        $this->apiParas['from_date_time'] = $fromDateTime;
    }

    public function getFromDateTime()
    {
        return $this->fromDateTime;
    }

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setToDateTime($toDateTime)
    {
        $this->toDateTime = $toDateTime;
        $this->apiParas['to_date_time'] = $toDateTime;
    }

    public function getToDateTime()
    {
        return $this->toDateTime;
    }

    public function setUserids($userids)
    {
        $this->userids = $userids;
        $this->apiParas['userids'] = $userids;
    }

    public function getUserids()
    {
        return $this->userids;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.schedule.shift.listbydays';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->fromDateTime, 'fromDateTime');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->toDateTime, 'toDateTime');
        RequestCheckUtil::checkNotNull($this->userids, 'userids');
        RequestCheckUtil::checkMaxListSize($this->userids, 20, 'userids');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
