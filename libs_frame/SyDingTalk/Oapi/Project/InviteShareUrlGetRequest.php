<?php

namespace SyDingTalk\Oapi\Project;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.project.invite.shareurl.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.09
 */
class InviteShareUrlGetRequest extends BaseRequest
{
    /**
     * 邀请信息
     */
    private $inviteInfo;

    public function setInviteInfo($inviteInfo)
    {
        $this->inviteInfo = $inviteInfo;
        $this->apiParas['invite_info'] = $inviteInfo;
    }

    public function getInviteInfo()
    {
        return $this->inviteInfo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.project.invite.shareurl.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
