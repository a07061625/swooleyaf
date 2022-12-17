<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 子管理员权限范围（w表示可管理，r表示可读）
 *
 * @author auto create
 */
class TopGroupManageRolePermissionVo
{
    /**
     * 设置拍照打卡规则
     */
    public $camera_check;

    /**
     * 设置打卡方式
     */
    public $check_position_type;

    /**
     * 设置考勤时间
     */
    public $check_time;

    /**
     * 设置参与考勤人员
     */
    public $group_member;

    /**
     * 设置考勤类型
     */
    public $group_type;

    /**
     * 设置外勤打卡
     */
    public $out_side_check;

    /**
     * 设置加班规则
     */
    public $over_time_rule;

    /**
     * 员工排班
     */
    public $schedule;
}
