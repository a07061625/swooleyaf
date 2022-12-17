<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * data
 *
 * @author auto create
 */
class McsDeptSummaryVo
{
    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 参与人次
     */
    public $join_count;

    /**
     * 平均时长（分钟）
     */
    public $start_avg_len_min;

    /**
     * 发起会议次数
     */
    public $start_count;

    /**
     * 发起会议总时长（分钟）
     */
    public $start_len_min;
}
