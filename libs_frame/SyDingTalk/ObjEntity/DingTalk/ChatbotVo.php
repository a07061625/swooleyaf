<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 安装的机器人信息
 *
 * @author auto create
 */
class ChatbotVo
{
    /**
     * 0-正常，1-只服务端可管理
     */
    public $authority;

    /**
     * 2-企业对内机器人，3-企业对外机器人
     */
    public $bot_type;

    /**
     * 机器人简介
     */
    public $breif;

    /**
     * 机器人id(钉钉分配)
     */
    public $chatbot_id;

    /**
     * 机器详细介绍
     */
    public $description;

    /**
     * INCOMING = 1,OUTGOING  = 2,INOUT     = 3
     */
    public $function;

    /**
     * 机器人头像mediaId
     */
    public $icon;

    /**
     * 向群添加机器人时是否可改头像：0-不可必，1-可改
     */
    public $icon_mdify;

    /**
     * 手机端是否能添加机器人：0-移动端不能加，1-移动端能添加
     */
    public $mobile_switch;

    /**
     * 机器人的名字
     */
    public $name;

    /**
     * 向群添加机器人时是否可改名字：0-不可必，1-可改
     */
    public $name_modify;

    /**
     * 是否支持单聊：0-不要单聊，1需要单聊
     */
    public $oto_support;

    /**
     * 机器人消息回调时在header中添加的token,用于对钉钉鉴权
     */
    public $outgoing_token;

    /**
     * 机器人回调URL
     */
    public $outgoing_url;

    /**
     * 机器人预览图
     */
    public $preview_media_id;
}
