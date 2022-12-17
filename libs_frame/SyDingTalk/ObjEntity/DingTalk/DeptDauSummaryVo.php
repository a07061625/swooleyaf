<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据列表
 *
 * @author auto create
 */
class DeptDauSummaryVo
{
    /**
     * 钉钉app端登录人数
     */
    public $app_active_users;

    /**
     * 通讯录人数
     */
    public $contacts_number;

    /**
     * 日活跃人数
     */
    public $daily_active_users;

    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 钉钉pc端登录人数
     */
    public $pc_active_users;
}
