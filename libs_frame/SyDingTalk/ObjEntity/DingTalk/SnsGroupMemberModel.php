<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 成员列表
 *
 * @author auto create
 */
class SnsGroupMemberModel
{
    /**
     * 群昵称
     */
    public $group_nick_name;

    /**
     * 昵称
     */
    public $nick_name;

    /**
     * 头像url
     */
    public $portrait_url;

    /**
     * 角色，1-群主 2-管理员 3-普通成员
     */
    public $role;

    /**
     * 用户id
     */
    public $unionid;
}
