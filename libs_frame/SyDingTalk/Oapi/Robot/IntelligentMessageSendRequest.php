<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.intelligent.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.09
 */
class IntelligentMessageSendRequest extends BaseRequest
{
    /**
     * at人的unionId列表
     */
    private $atUnionIds;
    /**
     * 申请到的消息模板唯一标识符
     */
    private $msgKey;
    /**
     * 消息模板中，变量本次替换的值
     */
    private $msgParam;
    /**
     * 开放的群ID
     */
    private $openConversationId;
    /**
     * 消息接收者的unionId列表，如果不传则表示群全员可见
     */
    private $receiverUnionIds;

    public function setAtUnionIds($atUnionIds)
    {
        $this->atUnionIds = $atUnionIds;
        $this->apiParas['at_union_ids'] = $atUnionIds;
    }

    public function getAtUnionIds()
    {
        return $this->atUnionIds;
    }

    public function setMsgKey($msgKey)
    {
        $this->msgKey = $msgKey;
        $this->apiParas['msg_key'] = $msgKey;
    }

    public function getMsgKey()
    {
        return $this->msgKey;
    }

    public function setMsgParam($msgParam)
    {
        $this->msgParam = $msgParam;
        $this->apiParas['msg_param'] = $msgParam;
    }

    public function getMsgParam()
    {
        return $this->msgParam;
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

    public function setReceiverUnionIds($receiverUnionIds)
    {
        $this->receiverUnionIds = $receiverUnionIds;
        $this->apiParas['receiver_union_ids'] = $receiverUnionIds;
    }

    public function getReceiverUnionIds()
    {
        return $this->receiverUnionIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.intelligent.message.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->atUnionIds, 999, 'atUnionIds');
        RequestCheckUtil::checkNotNull($this->msgKey, 'msgKey');
        RequestCheckUtil::checkNotNull($this->msgParam, 'msgParam');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkMaxListSize($this->receiverUnionIds, 999, 'receiverUnionIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
