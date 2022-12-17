<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 成员列表
 *
 * @author auto create
 */
class Members
{
    /**
     * 成员的ID
     */
    public $dingtalk_id;

    /**
     * 群昵称
     */
    public $group_nick_name;

    /**
     * 昵称
     */
    public $nick_name;

    /**
     * 角色，2-管理员、3-普通成员
     */
    public $role;

    /**
     * 员工Id
     */
    public $userid;
}
