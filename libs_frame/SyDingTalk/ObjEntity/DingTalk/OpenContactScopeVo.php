<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 通讯录约束条件
 *
 * @author auto create
 */
class OpenContactScopeVo
{
    /**
     * 被授权人可管理的部门列表
     */
    public $dept_ids;

    /**
     * 被授权人所在部门
     */
    public $include_member_depts;

    /**
     * 被授权人所能管理的部门
     */
    public $include_self_manage_depts;

    /**
     * 被授权人可管理的员工列表
     */
    public $userids;
}
