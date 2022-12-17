<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建会话请求
 *
 * @author auto create
 */
class CreateConversationRequest
{
    /**
     * 接入方channel信息，该值由接入方接入IMPaaS平台时，向IMPaaS平台申请，例如“hema”“eleme”等。
     */
    public $channel;

    /**
     * 扩展数据,业务可以自定义，目前最大支持256B
     */
    public $extension;

    /**
     * 接收者
     */
    public $receiver;

    /**
     * 接收者二级会话入口ID
     */
    public $receiver_entrance_id;

    /**
     * 发送者
     */
    public $sender;

    /**
     * 发送者二级会话入口ID
     */
    public $sender_entrance_id;

    /**
     * uuid, 用于防止弱网情况下超时导致重复创建, 一分钟内传递相同的uuid会返回同一个群，传空则不去重
     */
    public $uuid;
}
