<?php

namespace SyDingTalk\Oapi\Customize;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.customize.conversation.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.18
 */
class ConversationUpdateRequest extends BaseRequest
{
    /**
     * 会话id
     */
    private $chatId;
    /**
     * extensionKey
     */
    private $extensionKey;
    /**
     * extensionValue
     */
    private $extensionValue;
    /**
     * 员工账号
     */
    private $userid;

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setExtensionKey($extensionKey)
    {
        $this->extensionKey = $extensionKey;
        $this->apiParas['extension_key'] = $extensionKey;
    }

    public function getExtensionKey()
    {
        return $this->extensionKey;
    }

    public function setExtensionValue($extensionValue)
    {
        $this->extensionValue = $extensionValue;
        $this->apiParas['extension_value'] = $extensionValue;
    }

    public function getExtensionValue()
    {
        return $this->extensionValue;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customize.conversation.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatId, 'chatId');
        RequestCheckUtil::checkNotNull($this->extensionKey, 'extensionKey');
        RequestCheckUtil::checkNotNull($this->extensionValue, 'extensionValue');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
