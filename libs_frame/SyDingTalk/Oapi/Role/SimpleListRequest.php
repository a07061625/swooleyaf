<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.simplelist request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.12
 */
class SimpleListRequest extends BaseRequest
{
    /**
     * 支持分页查询，与size参数同时设置时才生效，此参数代表偏移量，偏移量从0开始。
     */
    private $offset;
    /**
     * 角色ID
     */
    private $roleId;
    /**
     * 支持分页查询，与offset参数同时设置时才生效，此参数代表分页大小，最大100。
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
        return 'dingtalk.oapi.role.simplelist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMinValue($this->offset, 0, 'offset');
        RequestCheckUtil::checkNotNull($this->roleId, 'roleId');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
