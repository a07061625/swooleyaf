<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 服务号详情
 *
 * @author auto create
 */
class ServiceAccountDTO
{
    /**
     * 头像图片mediaId
     */
    public $avatar_media_id;

    /**
     * 机器人管理列表中的简介，最多60个字符
     */
    public $brief;

    /**
     * 机器人id
     */
    public $chat_bot_id;

    /**
     * 机器人主页中的服务号功能简介，最多200个字符
     */
    public $desc;

    /**
     * 服务号名称
     */
    public $name;

    /**
     * 机器人主页中，消息预览图片的mediaId
     */
    public $preview_media_id;

    /**
     * 状态，normal-正常，disabled-删除
     */
    public $status;

    /**
     * 服务号的unionid
     */
    public $unionid;
}
