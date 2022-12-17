<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 考勤组列表
 *
 * @author auto create
 */
class AtGroupForTopVo
{
    /**
     * 一周的班次时间展示列表。["周一、二 班次A:09:00-18:00", "周六、周日 休息"]
     */
    public $classes_list;

    /**
     * 默认班次id
     */
    public $default_class_id;

    /**
     * 关联的部门
     */
    public $dept_name_list;

    /**
     * 考勤组id
     */
    public $group_id;

    /**
     * 考勤组名称
     */
    public $group_name;

    /**
     * 是否默认考勤组
     */
    public $is_default;

    /**
     * 考勤组负责人
     */
    public $manager_list;

    /**
     * 成员人数
     */
    public $member_count;

    /**
     * 考勤组对应的考勤班次列表
     */
    public $selected_class;

    /**
     * 考勤类型，FIXED为固定排班，TURN为轮班排班，NONE为无班次
     */
    public $type;

    /**
     * 固定班次的工作日班次
     */
    public $work_day_list;
}
