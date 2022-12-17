<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.corp.inviteactive.open request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class CorpInviteActiveOpenRequest extends BaseRequest
{
    /**
     * 姓名
     */
    private $adminName;
    /**
     * 手机号
     */
    private $adminPhone;

    public function setAdminName($adminName)
    {
        $this->adminName = $adminName;
        $this->apiParas['admin_name'] = $adminName;
    }

    public function getAdminName()
    {
        return $this->adminName;
    }

    public function setAdminPhone($adminPhone)
    {
        $this->adminPhone = $adminPhone;
        $this->apiParas['admin_phone'] = $adminPhone;
    }

    public function getAdminPhone()
    {
        return $this->adminPhone;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.corp.inviteactive.open';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->adminName, 'adminName');
        RequestCheckUtil::checkNotNull($this->adminPhone, 'adminPhone');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
