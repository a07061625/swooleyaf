<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据明细列表
 *
 * @author auto create
 */
class VideoLiveDetailVo
{
    /**
     * 直播群cid
     */
    public $cid;

    /**
     * 部门ID
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 直播群名称
     */
    public $group_name;

    /**
     * 群人数
     */
    public $group_user_count;

    /**
     * 观看直播次数
     */
    public $live_watch_count;

    /**
     * 直播时长（秒）
     */
    public $live_watch_duration;

    /**
     * 直播时长（分钟）
     */
    public $live_watch_duration_min;

    /**
     * 直播结束时间
     */
    public $live_watch_end_time;

    /**
     * 直播开始时间
     */
    public $live_watch_start_time;

    /**
     * 直播标题
     */
    public $live_watch_title;

    /**
     * 观看直播人数
     */
    public $live_watch_user_count;

    /**
     * 群对外开放的id
     */
    public $open_conversation_id;

    /**
     * 直播发起人员工工号
     */
    public $staff_job_num;

    /**
     * 直播发起人用户名称
     */
    public $staff_name;

    /**
     * 员工在当前企业内的唯一标识，也称staffId。可由企业在创建时指定，并代表一定含义比如工号，创建后不可修改
     */
    public $userid;

    /**
     * 直播uuid
     */
    public $uuid;
}
