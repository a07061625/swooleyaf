<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.groupapp.sysmsg.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.30
 */
class GroupAppSysMsgSendRequest extends BaseRequest
{
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.groupapp.sysmsg.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->msgKey, 'msgKey');
        RequestCheckUtil::checkNotNull($this->msgParam, 'msgParam');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
