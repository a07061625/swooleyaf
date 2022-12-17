<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.interactivecard.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.11
 */
class ChatScenceGroupInteractiveCardSendRequest extends BaseRequest
{
    /**
     * 卡片模板内容替换参数-多媒体类型
     */
    private $cardMediaidParamMap;
    /**
     * 卡片模板内容替换参数-普通文本类型
     */
    private $cardParamMap;
    /**
     * 卡片模板ID
     */
    private $cardTemplateId;
    /**
     * 唯一标示卡片的外部编码
     */
    private $outTrackId;
    /**
     * 接收卡片的人的userId
     */
    private $receiverUseridList;
    /**
     * 用于发送卡片的机器人编码，与场景群模板中的机器人编码保持一致
     */
    private $robotCode;
    /**
     * 接收卡片的群的openConversationId
     */
    private $targetOpenConversationId;

    public function setCardMediaidParamMap($cardMediaidParamMap)
    {
        $this->cardMediaidParamMap = $cardMediaidParamMap;
        $this->apiParas['card_mediaid_param_map'] = $cardMediaidParamMap;
    }

    public function getCardMediaidParamMap()
    {
        return $this->cardMediaidParamMap;
    }

    public function setCardParamMap($cardParamMap)
    {
        $this->cardParamMap = $cardParamMap;
        $this->apiParas['card_param_map'] = $cardParamMap;
    }

    public function getCardParamMap()
    {
        return $this->cardParamMap;
    }

    public function setCardTemplateId($cardTemplateId)
    {
        $this->cardTemplateId = $cardTemplateId;
        $this->apiParas['card_template_id'] = $cardTemplateId;
    }

    public function getCardTemplateId()
    {
        return $this->cardTemplateId;
    }

    public function setOutTrackId($outTrackId)
    {
        $this->outTrackId = $outTrackId;
        $this->apiParas['out_track_id'] = $outTrackId;
    }

    public function getOutTrackId()
    {
        return $this->outTrackId;
    }

    public function setReceiverUseridList($receiverUseridList)
    {
        $this->receiverUseridList = $receiverUseridList;
        $this->apiParas['receiver_userid_list'] = $receiverUseridList;
    }

    public function getReceiverUseridList()
    {
        return $this->receiverUseridList;
    }

    public function setRobotCode($robotCode)
    {
        $this->robotCode = $robotCode;
        $this->apiParas['robot_code'] = $robotCode;
    }

    public function getRobotCode()
    {
        return $this->robotCode;
    }

    public function setTargetOpenConversationId($targetOpenConversationId)
    {
        $this->targetOpenConversationId = $targetOpenConversationId;
        $this->apiParas['target_open_conversation_id'] = $targetOpenConversationId;
    }

    public function getTargetOpenConversationId()
    {
        return $this->targetOpenConversationId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scencegroup.interactivecard.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cardTemplateId, 'cardTemplateId');
        RequestCheckUtil::checkNotNull($this->outTrackId, 'outTrackId');
        RequestCheckUtil::checkMaxListSize($this->receiverUseridList, 999, 'receiverUseridList');
        RequestCheckUtil::checkNotNull($this->robotCode, 'robotCode');
        RequestCheckUtil::checkNotNull($this->targetOpenConversationId, 'targetOpenConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
