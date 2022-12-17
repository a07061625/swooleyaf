<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 排班周期设置
 *
 * @author auto create
 */
class TopCycleScheduleVO
{
    /**
     * 排班周期名称
     */
    public $cycle_name;

    /**
     * 是否删除
     */
    public $is_deleted;

    /**
     * 是否有效
     */
    public $is_valid;

    /**
     * 每天的班次设置
     */
    public $item_list;
}
