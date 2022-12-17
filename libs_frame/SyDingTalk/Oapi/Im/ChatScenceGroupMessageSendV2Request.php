<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.message.send_v2 request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.22
 */
class ChatScenceGroupMessageSendV2Request extends BaseRequest
{
    /**
     * @人的手机号列表
     */
    private $atMobiles;
    /**
     * @人的unionId列表
     */
    private $atUnionIds;
    /**
     * @人的员工id列表
     */
    private $atUsers;
    /**
     * 是否@所有人
     */
    private $isAtAll;
    /**
     * 消息模板内容替换参数-多媒体类型
     */
    private $msgMediaIdParamMap;
    /**
     * 消息模板内容替换参数-普通文本类型
     */
    private $msgParamMap;
    /**
     * 模板ID
     */
    private $msgTemplateId;
    /**
     * 消息接收人手机号列表（不设置任何接收人则全部可见）
     */
    private $receiverMobiles;
    /**
     * 消息接收人 unionId 列表（不设置任何接收人则全部可见）
     */
    private $receiverUnionIds;
    /**
     * 消息接收人 userId 列表 （不设置任何接收人则全部可见）
     */
    private $receiverUserIds;
    /**
     * 用于发送卡片的机器人编码，与场景群模板中的机器人编码保持一致
     */
    private $robotCode;
    /**
     * 接收消息的群的openConversationId
     */
    private $targetOpenConversationId;

    public function setAtMobiles($atMobiles)
    {
        $this->atMobiles = $atMobiles;
        $this->apiParas['at_mobiles'] = $atMobiles;
    }

    public function getAtMobiles()
    {
        return $this->atMobiles;
    }

    public function setAtUnionIds($atUnionIds)
    {
        $this->atUnionIds = $atUnionIds;
        $this->apiParas['at_union_ids'] = $atUnionIds;
    }

    public function getAtUnionIds()
    {
        return $this->atUnionIds;
    }

    public function setAtUsers($atUsers)
    {
        $this->atUsers = $atUsers;
        $this->apiParas['at_users'] = $atUsers;
    }

    public function getAtUsers()
    {
        return $this->atUsers;
    }

    public function setIsAtAll($isAtAll)
    {
        $this->isAtAll = $isAtAll;
        $this->apiParas['is_at_all'] = $isAtAll;
    }

    public function getIsAtAll()
    {
        return $this->isAtAll;
    }

    public function setMsgMediaIdParamMap($msgMediaIdParamMap)
    {
        $this->msgMediaIdParamMap = $msgMediaIdParamMap;
        $this->apiParas['msg_media_id_param_map'] = $msgMediaIdParamMap;
    }

    public function getMsgMediaIdParamMap()
    {
        return $this->msgMediaIdParamMap;
    }

    public function setMsgParamMap($msgParamMap)
    {
        $this->msgParamMap = $msgParamMap;
        $this->apiParas['msg_param_map'] = $msgParamMap;
    }

    public function getMsgParamMap()
    {
        return $this->msgParamMap;
    }

    public function setMsgTemplateId($msgTemplateId)
    {
        $this->msgTemplateId = $msgTemplateId;
        $this->apiParas['msg_template_id'] = $msgTemplateId;
    }

    public function getMsgTemplateId()
    {
        return $this->msgTemplateId;
    }

    public function setReceiverMobiles($receiverMobiles)
    {
        $this->receiverMobiles = $receiverMobiles;
        $this->apiParas['receiver_mobiles'] = $receiverMobiles;
    }

    public function getReceiverMobiles()
    {
        return $this->receiverMobiles;
    }

    public function setReceiverUnionIds($receiverUnionIds)
    {
        $this->receiverUnionIds = $receiverUnionIds;
        $this->apiParas['receiver_union_ids'] = $receiverUnionIds;
    }

    public function getReceiverUnionIds()
    {
        return $this->receiverUnionIds;
    }

    public function setReceiverUserIds($receiverUserIds)
    {
        $this->receiverUserIds = $receiverUserIds;
        $this->apiParas['receiver_user_ids'] = $receiverUserIds;
    }

    public function getReceiverUserIds()
    {
        return $this->receiverUserIds;
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
        return 'dingtalk.oapi.im.chat.scencegroup.message.send_v2';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->atMobiles, 999, 'atMobiles');
        RequestCheckUtil::checkMaxListSize($this->atUnionIds, 999, 'atUnionIds');
        RequestCheckUtil::checkMaxListSize($this->atUsers, 999, 'atUsers');
        RequestCheckUtil::checkNotNull($this->msgTemplateId, 'msgTemplateId');
        RequestCheckUtil::checkMaxListSize($this->receiverMobiles, 999, 'receiverMobiles');
        RequestCheckUtil::checkMaxListSize($this->receiverUnionIds, 999, 'receiverUnionIds');
        RequestCheckUtil::checkMaxListSize($this->receiverUserIds, 999, 'receiverUserIds');
        RequestCheckUtil::checkNotNull($this->targetOpenConversationId, 'targetOpenConversationId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
