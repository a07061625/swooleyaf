<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 人员userId列表
 *
 * @author auto create
 */
class TopGroupMemberVo
{
    /**
     * 0表示需要考勤，1表示无需考勤人员
     */
    public $atc_flag;

    /**
     * 成员id，可以是userId或deptId
     */
    public $member_id;

    /**
     * 0表示员工，1表示部门
     */
    public $type;
}
