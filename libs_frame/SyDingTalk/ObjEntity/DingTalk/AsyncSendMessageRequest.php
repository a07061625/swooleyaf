<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 发送消息的结构
 *
 * @author auto create
 */
class AsyncSendMessageRequest
{
    /**
     * 群ID
     */
    public $group_id;

    /**
     * 消息内容，根据msgtype不同，解析方式不同
     */
    public $msg_content;

    /**
     * 消息的可扩展字段，透传
     */
    public $msg_extension;

    /**
     * 消息的特性：静默消息，系统消息
     */
    public $msg_feature;

    /**
     * 消息类型：text，image，user-defined
     */
    public $msg_type;

    /**
     * 接受者，暂不支持，可不填
     */
    public $receiverid_list;

    /**
     * 发送者，暂不支持，可不填
     */
    public $senderid;

    /**
     * 推送信息
     */
    public $xpn_model;
}
