<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class MsgStatResVo
{
    /**
     * 机器人消息推送Id
     */
    public $push_id;

    /**
     * 触达群数量
     */
    public $reach_group_count;

    /**
     * 触达群成员数量
     */
    public $reach_group_member_count;

    /**
     * 触达群成员未读数量
     */
    public $reach_group_member_unread_count;
}
