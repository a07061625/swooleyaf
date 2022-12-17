<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.intelligent.card.send request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.26
 */
class IntelligentCardSendRequest extends BaseRequest
{
    /**
     * 群助理的biz类型
     */
    private $bizType;
    /**
     * 加密的群id
     */
    private $openConversationId;
    /**
     * 动态卡片的json格式模板
     */
    private $templateData;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
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

    public function setTemplateData($templateData)
    {
        $this->templateData = $templateData;
        $this->apiParas['template_data'] = $templateData;
    }

    public function getTemplateData()
    {
        return $this->templateData;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.intelligent.card.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizType, 'bizType');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkNotNull($this->templateData, 'templateData');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
