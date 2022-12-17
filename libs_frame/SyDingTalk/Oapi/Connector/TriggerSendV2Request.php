<?php

namespace SyDingTalk\Oapi\Connector;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.connector.trigger.send_v2 request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.06
 */
class TriggerSendV2Request extends BaseRequest
{
    /**
     * 触发消息请求结构体
     */
    private $triggerMsgRequest;

    public function setTriggerMsgRequest($triggerMsgRequest)
    {
        $this->triggerMsgRequest = $triggerMsgRequest;
        $this->apiParas['trigger_msg_request'] = $triggerMsgRequest;
    }

    public function getTriggerMsgRequest()
    {
        return $this->triggerMsgRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.connector.trigger.send_v2';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
