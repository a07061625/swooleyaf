<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.message.systemaccount.sendmessage request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.27
 */
class MessageSystemAccountSendMessageRequest extends BaseRequest
{
    /**
     * 模板内容value
     */
    private $content;
    /**
     * 消息模板code
     */
    private $messageBizCode;
    /**
     * 用户ID
     */
    private $openid;

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setMessageBizCode($messageBizCode)
    {
        $this->messageBizCode = $messageBizCode;
        $this->apiParas['message_biz_code'] = $messageBizCode;
    }

    public function getMessageBizCode()
    {
        return $this->messageBizCode;
    }

    public function setOpenid($openid)
    {
        $this->openid = $openid;
        $this->apiParas['openid'] = $openid;
    }

    public function getOpenid()
    {
        return $this->openid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.message.systemaccount.sendmessage';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->content, 'content');
        RequestCheckUtil::checkNotNull($this->messageBizCode, 'messageBizCode');
        RequestCheckUtil::checkNotNull($this->openid, 'openid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
