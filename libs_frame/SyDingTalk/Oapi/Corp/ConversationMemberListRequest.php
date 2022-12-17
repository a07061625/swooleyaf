<?php

namespace SyDingTalk\Oapi\Corp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.corp.conversation.member.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ConversationMemberListRequest extends BaseRequest
{
    /**
     * 会话ID
     */
    private $chatId;
    /**
     * 偏移位置，从0开始，后续传offset+size的值。member_list返回为空表示结束了。
     */
    private $offset;
    /**
     * 请求数量
     */
    private $size;

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.corp.conversation.member.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatId, 'chatId');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 200, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
