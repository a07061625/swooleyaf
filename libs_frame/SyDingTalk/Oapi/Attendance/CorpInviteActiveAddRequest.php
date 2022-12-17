<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.corp.inviteactive.add request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class CorpInviteActiveAddRequest extends BaseRequest
{
    /**
     * 管理员的手机号
     */
    private $adminMobile;
    /**
     * 被邀请员工的手机号
     */
    private $invitedMobile;

    public function setAdminMobile($adminMobile)
    {
        $this->adminMobile = $adminMobile;
        $this->apiParas['admin_mobile'] = $adminMobile;
    }

    public function getAdminMobile()
    {
        return $this->adminMobile;
    }

    public function setInvitedMobile($invitedMobile)
    {
        $this->invitedMobile = $invitedMobile;
        $this->apiParas['invited_mobile'] = $invitedMobile;
    }

    public function getInvitedMobile()
    {
        return $this->invitedMobile;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.corp.inviteactive.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->adminMobile, 'adminMobile');
        RequestCheckUtil::checkNotNull($this->invitedMobile, 'invitedMobile');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
