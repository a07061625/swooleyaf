<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.sendoto request
 *
 * @author auto create
 *
 * @since 1.0, 2022.03.30
 */
class MessageSendOtoRequest extends BaseRequest
{
    /**
     * 申请到的企业机器人唯一标识符
     */
    private $chatbotId;
    /**
     * 申请到的消息模板唯一标识符
     */
    private $msgKey;
    /**
     * 消息模板中，变量本次替换的值
     */
    private $msgParam;
    /**
     * 员工的userid
     */
    private $staffId;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
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

    public function setStaffId($staffId)
    {
        $this->staffId = $staffId;
        $this->apiParas['staff_id'] = $staffId;
    }

    public function getStaffId()
    {
        return $this->staffId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.sendoto';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotId, 'chatbotId');
        RequestCheckUtil::checkNotNull($this->msgKey, 'msgKey');
        RequestCheckUtil::checkNotNull($this->msgParam, 'msgParam');
        RequestCheckUtil::checkNotNull($this->staffId, 'staffId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
