<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scenegroup.template.apply request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.24
 */
class ChatSceneGroupTemplateApplyRequest extends BaseRequest
{
    /**
     * 启用模式
     */
    private $applyMode;
    /**
     * 加密cid,必填
     */
    private $openConversationId;
    /**
     * 群主userid
     */
    private $ownerUserId;
    /**
     * 群模板ID
     */
    private $templateId;

    public function setApplyMode($applyMode)
    {
        $this->applyMode = $applyMode;
        $this->apiParas['apply_mode'] = $applyMode;
    }

    public function getApplyMode()
    {
        return $this->applyMode;
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

    public function setOwnerUserId($ownerUserId)
    {
        $this->ownerUserId = $ownerUserId;
        $this->apiParas['owner_user_id'] = $ownerUserId;
    }

    public function getOwnerUserId()
    {
        return $this->ownerUserId;
    }

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        $this->apiParas['template_id'] = $templateId;
    }

    public function getTemplateId()
    {
        return $this->templateId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scenegroup.template.apply';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkNotNull($this->ownerUserId, 'ownerUserId');
        RequestCheckUtil::checkNotNull($this->templateId, 'templateId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
