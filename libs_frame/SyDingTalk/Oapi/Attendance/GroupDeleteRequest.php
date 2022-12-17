<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.group.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.26
 */
class GroupDeleteRequest extends BaseRequest
{
    /**
     * 考勤组id
     */
    private $groupKey;
    /**
     * 操作人userId
     */
    private $opUserid;

    public function setGroupKey($groupKey)
    {
        $this->groupKey = $groupKey;
        $this->apiParas['group_key'] = $groupKey;
    }

    public function getGroupKey()
    {
        return $this->groupKey;
    }

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.group.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupKey, 'groupKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
