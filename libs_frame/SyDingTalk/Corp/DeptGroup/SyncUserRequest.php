<?php

namespace SyDingTalk\Corp\DeptGroup;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.deptgroup.syncuser request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class SyncUserRequest extends BaseRequest
{
    /**
     * 部门id
     */
    private $deptId;
    /**
     * 用户id
     */
    private $userid;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
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
        return 'dingtalk.corp.deptgroup.syncuser';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
