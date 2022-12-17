<?php

namespace SyDingTalk\Oapi\DingTalk;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingtalk.impaas.message.crossdomain.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.01
 */
class ImPaasMessageCrossDomainSendRequest extends BaseRequest
{
    /**
     * 互通消息结构
     */
    private $crossdomainMessageSendModel;

    public function setCrossdomainMessageSendModel($crossdomainMessageSendModel)
    {
        $this->crossdomainMessageSendModel = $crossdomainMessageSendModel;
        $this->apiParas['crossdomain_message_send_model'] = $crossdomainMessageSendModel;
    }

    public function getCrossdomainMessageSendModel()
    {
        return $this->crossdomainMessageSendModel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingtalk.impaas.message.crossdomain.send';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
