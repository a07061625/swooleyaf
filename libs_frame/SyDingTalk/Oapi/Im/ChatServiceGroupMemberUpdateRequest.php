<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.servicegroup.member.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ChatServiceGroupMemberUpdateRequest extends BaseRequest
{
    /**
     * 更新类型，REMOVE 移除、SET_ADMIN设为管理员、SET_NORMAL 设为普通成员
     */
    private $action;
    /**
     * 开放的chatId
     */
    private $chatId;
    /**
     * 成员的ID列表，英文逗号分隔
     */
    private $memberDingtalkIds;

    public function setAction($action)
    {
        $this->action = $action;
        $this->apiParas['action'] = $action;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setMemberDingtalkIds($memberDingtalkIds)
    {
        $this->memberDingtalkIds = $memberDingtalkIds;
        $this->apiParas['member_dingtalk_ids'] = $memberDingtalkIds;
    }

    public function getMemberDingtalkIds()
    {
        return $this->memberDingtalkIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.servicegroup.member.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->action, 'action');
        RequestCheckUtil::checkNotNull($this->chatId, 'chatId');
        RequestCheckUtil::checkNotNull($this->memberDingtalkIds, 'memberDingtalkIds');
        RequestCheckUtil::checkMaxListSize($this->memberDingtalkIds, 20, 'memberDingtalkIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
