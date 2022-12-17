<?php

namespace SyDingTalk\Oapi\Project;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.project.invite.data.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.28
 */
class InviteDataQueryRequest extends BaseRequest
{
    /**
     * 请求对象
     */
    private $inviteDataQuery;

    public function setInviteDataQuery($inviteDataQuery)
    {
        $this->inviteDataQuery = $inviteDataQuery;
        $this->apiParas['invite_data_query'] = $inviteDataQuery;
    }

    public function getInviteDataQuery()
    {
        return $this->inviteDataQuery;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.project.invite.data.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
