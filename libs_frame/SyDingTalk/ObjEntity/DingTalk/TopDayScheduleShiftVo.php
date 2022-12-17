<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class TopDayScheduleShiftVo
{
    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 考勤组id
     */
    public $group_id;

    /**
     * 班次id
     */
    public $shift_ids;

    /**
     * 班次名称
     */
    public $shift_names;

    /**
     * 班次版本id
     */
    public $shift_versions;

    /**
     * 人员userId
     */
    public $userid;

    /**
     * 工作日
     */
    public $work_date;
}
