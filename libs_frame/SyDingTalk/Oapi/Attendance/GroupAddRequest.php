<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.03
 */
class GroupAddRequest extends BaseRequest
{
    /**
     * 操作人id
     */
    private $opUserId;
    /**
     * 考勤组信息
     */
    private $topGroup;

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setTopGroup($topGroup)
    {
        $this->topGroup = $topGroup;
        $this->apiParas['top_group'] = $topGroup;
    }

    public function getTopGroup()
    {
        return $this->topGroup;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
