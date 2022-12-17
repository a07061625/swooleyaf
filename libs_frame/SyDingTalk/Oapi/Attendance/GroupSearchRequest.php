<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.search request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.31
 */
class GroupSearchRequest extends BaseRequest
{
    /**
     * 考勤组名称
     */
    private $groupName;
    /**
     * 操作者userId
     */
    private $opUserId;

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        $this->apiParas['group_name'] = $groupName;
    }

    public function getGroupName()
    {
        return $this->groupName;
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
        return 'dingtalk.oapi.attendance.group.search';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupName, 'groupName');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
