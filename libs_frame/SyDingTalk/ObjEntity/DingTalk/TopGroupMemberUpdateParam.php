<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 更新入参
 *
 * @author auto create
 */
class TopGroupMemberUpdateParam
{
    /**
     * 要添加的考勤部门，没有的话，无需赋值
     */
    public $add_depts;

    /**
     * 要添加的无需考勤人员，没有的话，无需赋值
     */
    public $add_extra_users;

    /**
     * 要添加的考勤人员，没有的话，无需赋值
     */
    public $add_users;

    /**
     * 要删除的考勤部门，没有的话，无需赋值
     */
    public $remove_depts;

    /**
     * 要删除的无需考勤人员，没有的话，无需赋值
     */
    public $remove_extra_users;

    /**
     * 要删除的考勤人员，没有的话，无需赋值
     */
    public $remove_users;
}
