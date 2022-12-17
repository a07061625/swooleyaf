<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 人员列表
 *
 * @author auto create
 */
class UnactivatedUserVo
{
    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 员工工号
     */
    public $staff_job_num;

    /**
     * 员工姓名
     */
    public $staff_name;

    /**
     * 员工在当前企业内的唯一标识，也称staffId。可由企业在创建时指定，并代表一定含义比如工号，创建后不可修改
     */
    public $userid;
}
