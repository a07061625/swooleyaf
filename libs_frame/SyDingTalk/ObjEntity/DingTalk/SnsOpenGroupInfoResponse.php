<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果数据
 *
 * @author auto create
 */
class SnsOpenGroupInfoResponse
{
    /**
     * 群头像
     */
    public $icon;

    /**
     * 会话ID
     */
    public $open_conversation_id;

    /**
     * 群主id
     */
    public $owner_unionid;

    /**
     * 机器人发消息地址
     */
    public $robot_web_hook_url;

    /**
     * 模板id
     */
    public $template_id;

    /**
     * 群名称
     */
    public $title;
}
