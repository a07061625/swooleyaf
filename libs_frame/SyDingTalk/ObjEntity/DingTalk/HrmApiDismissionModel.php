<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 实际每条数据
 *
 * @author auto create
 */
class HrmApiDismissionModel
{
    /**
     * 入职时间
     */
    public $confirm_join_time;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 离职描述
     */
    public $dismission_memo;

    /**
     * 离职原因（1：家庭原因，2:个人原因，3：发展原因，4：合同到期不续签，5：协议解除，6：无法胜任工作，7：经济性裁员，8：严重违法违纪，9：其他）
     */
    public $dismission_reason;

    /**
     * email
     */
    public $email;

    /**
     * 员工状态（-1:无状态，1:待入职，2:试用，3:正式，4:离职，5:待离职）
     */
    public $employee_status;

    /**
     * 员工类型（0:无类型，1:全职，2:兼职，3:实习，4:劳务派遣，5:退休返聘，6:劳务外包）
     */
    public $employee_type;

    /**
     * 离职时间
     */
    public $last_work_date;

    /**
     * 名称
     */
    public $name;

    /**
     * 职位
     */
    public $position;

    /**
     * userId
     */
    public $userid;
}
