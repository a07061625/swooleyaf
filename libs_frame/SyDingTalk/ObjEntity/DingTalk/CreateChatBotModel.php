<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建机器人modle
 *
 * @author auto create
 */
class CreateChatBotModel
{
    /**
     * 2-企业对内机器人，3-企业对外机器人
     */
    public $bot_type;

    /**
     * 机器人简介
     */
    public $breif;

    /**
     * 开通机器人企业id
     */
    public $corp_id;

    /**
     * 机器人功能详细描述
     */
    public $description;

    /**
     * 机器人头像
     */
    public $icon;

    /**
     * 微应用id
     */
    public $microapp_agent_id;

    /**
     * 机器人名字
     */
    public $name;

    /**
     * 机器人安全秘钥
     */
    public $outgoing_token;

    /**
     * 机器人回调URL
     */
    public $outgoing_url;

    /**
     * 机器人类型(钉钉分配)
     */
    public $type;
}
