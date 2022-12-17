<?php

namespace SyDingTalk\Oapi\Wiki;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.wiki.group.public.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.16
 */
class GroupPublicListRequest extends BaseRequest
{
    /**
     * 个人授权信息
     */
    private $authCode;
    /**
     * 分页游标（默认0）
     */
    private $cursor;
    /**
     * 1:管理员 2:编辑权限 3:只读权限
     */
    private $roleType;
    /**
     * 分页大小（默认20）
     */
    private $size;

    public function setAuthCode($authCode)
    {
        $this->authCode = $authCode;
        $this->apiParas['auth_code'] = $authCode;
    }

    public function getAuthCode()
    {
        return $this->authCode;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setRoleType($roleType)
    {
        $this->roleType = $roleType;
        $this->apiParas['role_type'] = $roleType;
    }

    public function getRoleType()
    {
        return $this->roleType;
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
        return 'dingtalk.oapi.wiki.group.public.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->authCode, 'authCode');
        RequestCheckUtil::checkNotNull($this->roleType, 'roleType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
