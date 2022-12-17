<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 系统自动生成
 *
 * @author auto create
 */
class TopScheduleParam
{
    /**
     * 是否休息（true表示休息，shift_id传1）
     */
    public $is_rest;

    /**
     * 班次id（休息班传1，清空班次传-2）
     */
    public $shift_id;

    /**
     * 人员userId
     */
    public $userid;

    /**
     * 排班日期
     */
    public $work_date;
}
