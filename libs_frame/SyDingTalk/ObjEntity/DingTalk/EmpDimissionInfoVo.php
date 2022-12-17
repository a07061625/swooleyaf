<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据结果
 *
 * @author auto create
 */
class EmpDimissionInfoVo
{
    /**
     * 离职部门列表
     */
    public $dept_list;

    /**
     * 离职交接人
     */
    public $handover_userid;

    /**
     * 最后工作日
     */
    public $last_work_day;

    /**
     * 离职前主部门id
     */
    public $main_dept_id;

    /**
     * 离职前主部门名称
     */
    public $main_dept_name;

    /**
     * 离职前工作状态：1，待入职；2，试用期；3，正式
     */
    public $pre_status;

    /**
     * 离职原因备注
     */
    public $reason_memo;

    /**
     * 离职原因类型：1，家庭原因；2，个人原因；3，发展原因；4，合同到期不续签；5，协议解除；6，无法胜任工作；7，经济性裁员；8，严重违法违纪；9，其他
     */
    public $reason_type;

    /**
     * 离职状态：1，待离职；2，已离职
     */
    public $status;

    /**
     * 员工id
     */
    public $userid;
}
