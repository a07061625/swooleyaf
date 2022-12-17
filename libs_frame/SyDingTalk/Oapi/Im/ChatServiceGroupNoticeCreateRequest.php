<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.servicegroup.notice.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.04
 */
class ChatServiceGroupNoticeCreateRequest extends BaseRequest
{
    /**
     * 要创建群公告的群id
     */
    private $chatId;
    /**
     * 是否发送ding提醒
     */
    private $sendDing;
    /**
     * 是否置顶
     */
    private $sticky;
    /**
     * 群公告内容
     */
    private $textContent;
    /**
     * 群公告标题
     */
    private $title;
    /**
     * 唯一性key，由调用方提供，避免重复操作。
     */
    private $uniqueKey;
    /**
     * 创建者id
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

    public function setSendDing($sendDing)
    {
        $this->sendDing = $sendDing;
        $this->apiParas['send_ding'] = $sendDing;
    }

    public function getSendDing()
    {
        return $this->sendDing;
    }

    public function setSticky($sticky)
    {
        $this->sticky = $sticky;
        $this->apiParas['sticky'] = $sticky;
    }

    public function getSticky()
    {
        return $this->sticky;
    }

    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;
        $this->apiParas['text_content'] = $textContent;
    }

    public function getTextContent()
    {
        return $this->textContent;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUniqueKey($uniqueKey)
    {
        $this->uniqueKey = $uniqueKey;
        $this->apiParas['unique_key'] = $uniqueKey;
    }

    public function getUniqueKey()
    {
        return $this->uniqueKey;
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
        return 'dingtalk.oapi.im.chat.servicegroup.notice.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatId, 'chatId');
        RequestCheckUtil::checkNotNull($this->textContent, 'textContent');
        RequestCheckUtil::checkMaxLength($this->textContent, 2000, 'textContent');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkMaxLength($this->title, 200, 'title');
        RequestCheckUtil::checkNotNull($this->uniqueKey, 'uniqueKey');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
