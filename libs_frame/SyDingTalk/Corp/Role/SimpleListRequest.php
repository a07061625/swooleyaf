<?php

namespace SyDingTalk\Corp\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.role.simplelist request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class SimpleListRequest extends BaseRequest
{
    /**
     * 分页偏移
     */
    private $offset;
    /**
     * 角色ID
     */
    private $roleId;
    /**
     * 分页大小
     */
    private $size;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setRoleId($roleId)
    {
        $this->roleId = $roleId;
        $this->apiParas['role_id'] = $roleId;
    }

    public function getRoleId()
    {
        return $this->roleId;
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
        return 'dingtalk.corp.role.simplelist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
