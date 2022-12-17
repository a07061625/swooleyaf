<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.role.addrolegroup request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class AddRoleGroupRequest extends BaseRequest
{
    /**
     * 名称
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.role.addrolegroup';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->name, 'name');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
