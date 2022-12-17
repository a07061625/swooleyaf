<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果数据
 *
 * @author auto create
 */
class ChildDto
{
    /**
     * 头像
     */
    public $avatar;

    /**
     * 孩子信息
     */
    public $bind_students;

    /**
     * 孩子nick
     */
    public $nick;

    /**
     * 孩子对应的openId 已废弃
     */
    public $open_id;

    /**
     * 孩子对应的unionId
     */
    public $union_id;

    /**
     * 孩子家庭userid
     */
    public $userid;
}
