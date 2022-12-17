<?php

namespace SyDingTalk\Oapi\Ccoservice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ccoservice.servicegroup.isignoreproblemcheck request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ServiceGroupIsIgnoreProblemCheckRequest extends BaseRequest
{
    /**
     * 用户dingtalk加密id
     */
    private $dingtalkId;
    /**
     * 群id
     */
    private $openConversationId;

    public function setDingtalkId($dingtalkId)
    {
        $this->dingtalkId = $dingtalkId;
        $this->apiParas['dingtalk_id'] = $dingtalkId;
    }

    public function getDingtalkId()
    {
        return $this->dingtalkId;
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
        return 'dingtalk.oapi.ccoservice.servicegroup.isignoreproblemcheck';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->dingtalkId, 'dingtalkId');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
