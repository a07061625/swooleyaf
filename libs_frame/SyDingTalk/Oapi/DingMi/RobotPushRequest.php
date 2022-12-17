<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingmi.robot.push request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.18
 */
class RobotPushRequest extends BaseRequest
{
    /**
     * 会话ID
     */
    private $conversationId;
    /**
     * 消息类型
     */
    private $msgKey;
    /**
     * 参考文档
     */
    private $msgParam;

    public function setConversationId($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->apiParas['conversation_id'] = $conversationId;
    }

    public function getConversationId()
    {
        return $this->conversationId;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingmi.robot.push';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
