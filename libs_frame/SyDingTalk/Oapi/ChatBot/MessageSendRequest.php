<?php

namespace SyDingTalk\Oapi\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chatbot.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.20
 */
class MessageSendRequest extends BaseRequest
{
    /**
     * 企业机器人模板类型
     */
    private $chatbotId;
    /**
     * 消息内容,支持的消息类型详见：https://open-doc.dingtalk.com/microapp/serverapi2/qf2nxq#a-namesgw3aga%E6%B6%88%E6%81%AF%E7%B1%BB%E5%9E%8B%E5%8F%8A%E6%95%B0%E6%8D%AE%E6%A0%BC%E5%BC%8F
     */
    private $message;
    /**
     * 企业员工ID
     */
    private $userid;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        $this->apiParas['message'] = $message;
    }

    public function getMessage()
    {
        return $this->message;
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
        return 'dingtalk.oapi.chatbot.message.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotId, 'chatbotId');
        RequestCheckUtil::checkNotNull($this->message, 'message');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
