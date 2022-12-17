<?php

namespace SyDingTalk\Oapi\Industry;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.industry.user.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.16
 */
class UserListRequest extends BaseRequest
{
    /**
     * 游标位置
     */
    private $cursor;
    /**
     * 部门id
     */
    private $deptId;
    /**
     * 标签
     */
    private $role;
    /**
     * 页尺寸
     */
    private $size;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->apiParas['role'] = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.industry.user.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deptId, 'deptId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
