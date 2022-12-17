<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.project.member.add request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.16
 */
class ProjectMemberAddRequest extends BaseRequest
{
    /**
     * 添加成员 最多20个
     */
    private $members;

    public function setMembers($members)
    {
        $this->members = $members;
        $this->apiParas['members'] = $members;
    }

    public function getMembers()
    {
        return $this->members;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.project.member.add';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
