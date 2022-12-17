<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * data
 *
 * @author auto create
 */
class VideoLiveDeptSummaryVo
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
     * 直播发起次数（成功）
     */
    public $live_launch_count;

    /**
     * 观看直播人数
     */
    public $live_play_user_count;

    /**
     * 直播时长（分钟）
     */
    public $live_time_length;
}
