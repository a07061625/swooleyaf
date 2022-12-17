<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.deletebyid request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.03
 */
class GroupDeletebyidRequest extends BaseRequest
{
    /**
     * 考勤组id
     */
    private $groupId;
    /**
     * 操作人id
     */
    private $opUserId;

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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.deletebyid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
