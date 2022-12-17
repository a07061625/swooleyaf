<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class MsgStatByPushIdResVo
{
    /**
     * 群Id
     */
    public $conversation_id;

    /**
     * 群成员数量
     */
    public $group_member_count;

    /**
     * 群成员未读数量
     */
    public $group_member_unread_count;

    /**
     * 机器人消息推送Id
     */
    public $push_id;
}
