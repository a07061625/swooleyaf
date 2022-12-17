<?php

namespace SyDingTalk\Oapi\Workspace;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.workspace.corp.member.add request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.15
 */
class CorpMemberAddRequest extends BaseRequest
{
    /**
     * 加人的成员列表
     */
    private $memberAddDtoList;
    /**
     * 目标加人组织
     */
    private $targetCorpId;

    public function setMemberAddDtoList($memberAddDtoList)
    {
        $this->memberAddDtoList = $memberAddDtoList;
        $this->apiParas['member_add_dto_list'] = $memberAddDtoList;
    }

    public function getMemberAddDtoList()
    {
        return $this->memberAddDtoList;
    }

    public function setTargetCorpId($targetCorpId)
    {
        $this->targetCorpId = $targetCorpId;
        $this->apiParas['target_corp_id'] = $targetCorpId;
    }

    public function getTargetCorpId()
    {
        return $this->targetCorpId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workspace.corp.member.add';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
