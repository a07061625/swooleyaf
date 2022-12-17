<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.schedule.listbyday request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.14
 */
class ScheduleListByDayRequest extends BaseRequest
{
    /**
     * 查询那天的数据
     */
    private $dateTime;
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 用户userId
     */
    private $userId;

    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
        $this->apiParas['date_time'] = $dateTime;
    }

    public function getDateTime()
    {
        return $this->dateTime;
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

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.schedule.listbyday';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dateTime, 'dateTime');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->userId, 'userId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
