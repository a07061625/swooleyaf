<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scenegroup.member.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.26
 */
class ChatSceneGroupMemberDeleteRequest extends BaseRequest
{
    /**
     * 客户联系人staffId
     */
    private $contactStaffIds;
    /**
     * 开放群id
     */
    private $openConversationId;
    /**
     * 员工userid
     */
    private $userIds;

    public function setContactStaffIds($contactStaffIds)
    {
        $this->contactStaffIds = $contactStaffIds;
        $this->apiParas['contact_staff_ids'] = $contactStaffIds;
    }

    public function getContactStaffIds()
    {
        return $this->contactStaffIds;
    }

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['user_ids'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scenegroup.member.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->contactStaffIds, 999, 'contactStaffIds');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkMaxListSize($this->userIds, 999, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
