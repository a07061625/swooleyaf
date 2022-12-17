<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * demo
 *
 * @author auto create
 */
class TopSimpleGroupVO
{
    /**
     * 考勤地址
     */
    public $address_list;

    /**
     * 排班周期设置
     */
    public $cycle_schedules;

    /**
     * id
     */
    public $id;

    /**
     * 考勤组管理员
     */
    public $manager_list;

    /**
     * 人员人数
     */
    public $member_count;

    /**
     * 名称
     */
    public $name;

    /**
     * 考勤组主负责人 id
     */
    public $owner_user_id;

    /**
     * 考勤组关联的班次列表
     */
    public $shift_ids;

    /**
     * 固定值，轮班制
     */
    public $type;

    /**
     * 跳转链接
     */
    public $url;

    /**
     * wifi名称
     */
    public $wifis;

    /**
     * 工作日
     */
    public $work_day_list;
}
