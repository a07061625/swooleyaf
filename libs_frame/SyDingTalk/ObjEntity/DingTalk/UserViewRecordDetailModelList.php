<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 用户观看记录
 *
 * @author auto create
 */
class UserViewRecordDetailModelList
{
    /**
     * 开始观看时间戳
     */
    public $live_begin_unix_time;

    /**
     * 结束观看时间戳
     */
    public $live_end_unix_time;

    /**
     * 用户id
     */
    public $user_id;

    /**
     * 用户名
     */
    public $user_name;

    /**
     * 0：直播 1：回放
     */
    public $view_type;

    /**
     * 观看时长，单位s
     */
    public $watch_time_second;
}
