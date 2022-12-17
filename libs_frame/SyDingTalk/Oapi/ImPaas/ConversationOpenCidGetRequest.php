<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.impaas.conversation.opencid.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.24
 */
class ConversationOpenCidGetRequest extends BaseRequest
{
    /**
     * 基础会话对象
     */
    private $model;

    public function setModel($model)
    {
        $this->model = $model;
        $this->apiParas['model'] = $model;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.impaas.conversation.opencid.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
