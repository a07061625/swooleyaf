<?php

namespace SyDingTalk\Oapi\SceneServiceGroup;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.sceneservicegroup.message.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.21
 */
class MessageSendRequest extends BaseRequest
{
    /**
     * 根据dingtalkId设置at用户
     */
    private $atDingtalkids;
    /**
     * 根据手机号设置at用户
     */
    private $atMobiles;
    /**
     * 根据unionId设置at用户
     */
    private $atUnionids;
    /**
     * 业务方自身系统关联ID，与开放群ID二选一填入
     */
    private $bizid;
    /**
     * 0-按钮竖直排列，1-按钮横向排列
     */
    private $btnOrientation;
    /**
     * card按钮
     */
    private $btns;
    /**
     * 消息内容
     */
    private $content;
    /**
     * 是否at所有人
     */
    private $isAtAll;
    /**
     * 消息类型
     */
    private $messageType;
    /**
     * 开放群ID
     */
    private $openConversationid;
    /**
     * 根据dingtalkId设置接收者
     */
    private $receiverDingtalkids;
    /**
     * 根据手机号设置接收者
     */
    private $receiverMobiles;
    /**
     * 根据unionId设置接收者
     */
    private $receiverUnionids;
    /**
     * 消息标题
     */
    private $title;

    public function setAtDingtalkids($atDingtalkids)
    {
        $this->atDingtalkids = $atDingtalkids;
        $this->apiParas['at_dingtalkids'] = $atDingtalkids;
    }

    public function getAtDingtalkids()
    {
        return $this->atDingtalkids;
    }

    public function setAtMobiles($atMobiles)
    {
        $this->atMobiles = $atMobiles;
        $this->apiParas['at_mobiles'] = $atMobiles;
    }

    public function getAtMobiles()
    {
        return $this->atMobiles;
    }

    public function setAtUnionids($atUnionids)
    {
        $this->atUnionids = $atUnionids;
        $this->apiParas['at_unionids'] = $atUnionids;
    }

    public function getAtUnionids()
    {
        return $this->atUnionids;
    }

    public function setBizid($bizid)
    {
        $this->bizid = $bizid;
        $this->apiParas['bizid'] = $bizid;
    }

    public function getBizid()
    {
        return $this->bizid;
    }

    public function setBtnOrientation($btnOrientation)
    {
        $this->btnOrientation = $btnOrientation;
        $this->apiParas['btn_orientation'] = $btnOrientation;
    }

    public function getBtnOrientation()
    {
        return $this->btnOrientation;
    }

    public function setBtns($btns)
    {
        $this->btns = $btns;
        $this->apiParas['btns'] = $btns;
    }

    public function getBtns()
    {
        return $this->btns;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
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

    public function setMessageType($messageType)
    {
        $this->messageType = $messageType;
        $this->apiParas['message_type'] = $messageType;
    }

    public function getMessageType()
    {
        return $this->messageType;
    }

    public function setOpenConversationid($openConversationid)
    {
        $this->openConversationid = $openConversationid;
        $this->apiParas['open_conversationid'] = $openConversationid;
    }

    public function getOpenConversationid()
    {
        return $this->openConversationid;
    }

    public function setReceiverDingtalkids($receiverDingtalkids)
    {
        $this->receiverDingtalkids = $receiverDingtalkids;
        $this->apiParas['receiver_dingtalkids'] = $receiverDingtalkids;
    }

    public function getReceiverDingtalkids()
    {
        return $this->receiverDingtalkids;
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

    public function setReceiverUnionids($receiverUnionids)
    {
        $this->receiverUnionids = $receiverUnionids;
        $this->apiParas['receiver_unionids'] = $receiverUnionids;
    }

    public function getReceiverUnionids()
    {
        return $this->receiverUnionids;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sceneservicegroup.message.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->atDingtalkids, 999, 'atDingtalkids');
        RequestCheckUtil::checkMaxListSize($this->atMobiles, 999, 'atMobiles');
        RequestCheckUtil::checkMaxListSize($this->atUnionids, 999, 'atUnionids');
        RequestCheckUtil::checkNotNull($this->content, 'content');
        RequestCheckUtil::checkNotNull($this->messageType, 'messageType');
        RequestCheckUtil::checkMaxListSize($this->receiverDingtalkids, 999, 'receiverDingtalkids');
        RequestCheckUtil::checkMaxListSize($this->receiverMobiles, 999, 'receiverMobiles');
        RequestCheckUtil::checkMaxListSize($this->receiverUnionids, 999, 'receiverUnionids');
        RequestCheckUtil::checkNotNull($this->title, 'title');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
