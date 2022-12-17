<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.member.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.16
 */
class GroupMemberUpdateRequest extends BaseRequest
{
    /**
     * 考勤组id
     */
    private $groupId;
    /**
     * 操作人userId
     */
    private $opUserId;
    /**
     * 0表示从今天开始排班，1表示从明天
     */
    private $scheduleFlag;
    /**
     * 更新入参
     */
    private $updateParam;

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

    public function setScheduleFlag($scheduleFlag)
    {
        $this->scheduleFlag = $scheduleFlag;
        $this->apiParas['schedule_flag'] = $scheduleFlag;
    }

    public function getScheduleFlag()
    {
        return $this->scheduleFlag;
    }

    public function setUpdateParam($updateParam)
    {
        $this->updateParam = $updateParam;
        $this->apiParas['update_param'] = $updateParam;
    }

    public function getUpdateParam()
    {
        return $this->updateParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.member.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupId, 'groupId');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->scheduleFlag, 'scheduleFlag');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
