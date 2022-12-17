<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 群信息
 *
 * @author auto create
 */
class GroupInfo
{
    /**
     * 群ID
     */
    public $chatid;

    /**
     * 群主
     */
    public $creater;

    /**
     * 群名称
     */
    public $group_name;

    /**
     * 群成员人数
     */
    public $member_count;

    /**
     * 群成员人数上限
     */
    public $member_limit;

    /**
     * 群类型
     */
    public $type;
}
