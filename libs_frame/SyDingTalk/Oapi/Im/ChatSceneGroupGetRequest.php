<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scenegroup.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.25
 */
class ChatSceneGroupGetRequest extends BaseRequest
{
    /**
     * 群id
     */
    private $openConversationId;

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
        return 'dingtalk.oapi.im.chat.scenegroup.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
