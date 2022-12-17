<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.org.intelligent.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.28
 */
class OrgIntelligentMessageSendRequest extends BaseRequest
{
    /**
     * at人的userid列表，英文逗号分隔
     */
    private $atUserIds;
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
     * 接收者userid列表，英文逗号分隔，不传表示全员接收
     */
    private $receiverUserIds;

    public function setAtUserIds($atUserIds)
    {
        $this->atUserIds = $atUserIds;
        $this->apiParas['at_user_ids'] = $atUserIds;
    }

    public function getAtUserIds()
    {
        return $this->atUserIds;
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

    public function setReceiverUserIds($receiverUserIds)
    {
        $this->receiverUserIds = $receiverUserIds;
        $this->apiParas['receiver_user_ids'] = $receiverUserIds;
    }

    public function getReceiverUserIds()
    {
        return $this->receiverUserIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.org.intelligent.message.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->atUserIds, 999, 'atUserIds');
        RequestCheckUtil::checkNotNull($this->msgKey, 'msgKey');
        RequestCheckUtil::checkNotNull($this->msgParam, 'msgParam');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkMaxListSize($this->receiverUserIds, 999, 'receiverUserIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
