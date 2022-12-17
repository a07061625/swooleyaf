<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 统计数据对象
 *
 * @author auto create
 */
class VideoLiveSummaryResponse
{
    /**
     * 成功发起5分钟直播次数
     */
    public $live_launch_succ5min_cnt;

    /**
     * 成功发起直播次数
     */
    public $live_launch_succ_cnt;

    /**
     * 观看直播次数
     */
    public $live_play_cnt;

    /**
     * 观看直播人数
     */
    public $live_play_user_cnt;

    /**
     * 成功发起直播时长
     */
    public $live_succ_time_len;

    /**
     * 观看人数最多直播的观看人数
     */
    public $max_user_cnt;

    /**
     * 最近一天看直播的人数（包含观看和回放
     */
    public $watch_group_live_user_cnt;
}
