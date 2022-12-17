<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.schedule.async request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.27
 */
class GroupScheduleAsyncRequest extends BaseRequest
{
    /**
     * 考勤组id
     */
    private $groupId;
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 系统自动生成
     */
    private $schedules;

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
        $this->apiParas['group_id'] = $groupId;
    }

    public function getGroupId()
    {
        return $this->groupId;
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

    public function setSchedules($schedules)
    {
        $this->schedules = $schedules;
        $this->apiParas['schedules'] = $schedules;
    }

    public function getSchedules()
    {
        return $this->schedules;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.schedule.async';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupId, 'groupId');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
