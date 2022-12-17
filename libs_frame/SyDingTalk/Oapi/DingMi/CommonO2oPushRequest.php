<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingmi.common.o2o.push request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.28
 */
class CommonO2oPushRequest extends BaseRequest
{
    /**
     * 机器人id
     */
    private $chatbotId;
    /**
     * 模板key
     */
    private $msgKey;
    /**
     * 模块替换值
     */
    private $msgParam;
    /**
     * 用户在服务号所在企业的用户id
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
        return 'dingtalk.oapi.dingmi.common.o2o.push';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
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
