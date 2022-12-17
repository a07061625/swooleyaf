<?php

namespace SyDingTalk\Corp\Conversation;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.conversation.corpconversion.listmember request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.21
 */
class CorpConversionListMemberRequest extends BaseRequest
{
    /**
     * 本次请求获取群成员的大小，最大为100
     */
    private $count;
    /**
     * 群成员列表偏移量
     */
    private $offset;
    /**
     * 群组id
     */
    private $openConversationId;

    public function setCount($count)
    {
        $this->count = $count;
        $this->apiParas['count'] = $count;
    }

    public function getCount()
    {
        return $this->count;
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

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.conversation.corpconversion.listmember';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->count, 'count');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
