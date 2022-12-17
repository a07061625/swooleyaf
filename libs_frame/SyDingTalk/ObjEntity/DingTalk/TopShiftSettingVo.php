<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 班次设置
 *
 * @author auto create
 */
class TopShiftSettingVo
{
    /**
     * 该班次对应的出勤天数
     */
    public $attend_days;

    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 固定时长弹性班次设置的工作时长
     */
    public $demand_work_time_minutes;

    /**
     * 创建时间
     */
    public $gmt_create;

    /**
     * 班次变更时间
     */
    public $gmt_modified;

    /**
     * id
     */
    public $id;

    /**
     * 删除标记
     */
    public $is_deleted;

    /**
     * 是否是弹性班次
     */
    public $is_flexible;

    /**
     * 班次id
     */
    public $shift_id;

    /**
     * 工作时长，单位分钟，-1表示关闭该功能
     */
    public $work_time_minutes;
}
