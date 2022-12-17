<?php

namespace SyDingTalk\Oapi\DingTalk;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingtalk.impaas.message.crossdomain.read request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.08
 */
class ImPaasMessageCrossDomainReadRequest extends BaseRequest
{
    /**
     * 消息已读结构
     */
    private $messageReadModel;

    public function setMessageReadModel($messageReadModel)
    {
        $this->messageReadModel = $messageReadModel;
        $this->apiParas['message_read_model'] = $messageReadModel;
    }

    public function getMessageReadModel()
    {
        return $this->messageReadModel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingtalk.impaas.message.crossdomain.read';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
