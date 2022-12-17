<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回值model
 *
 * @author auto create
 */
class OpenFeedInfoModel
{
    /**
     * 主播uid
     */
    public $anchor_id;

    /**
     * 绑定群的cid列表
     */
    public $chat_ids;

    /**
     * 封面链接
     */
    public $cover_url;

    /**
     * 直播时长（毫秒）
     */
    public $duration;

    /**
     * 剪辑过后的视频回放地址(含authkey,若空则代表没有经过剪辑)
     */
    public $edit_replay_url;

    /**
     * 直播结束时间
     */
    public $end_time;

    /**
     * 课程id
     */
    public $feed_id;

    /**
     * 课程类型
     */
    public $feed_type;

    /**
     * 是否有回放保存
     */
    public $has_play_back;

    /**
     * 简介
     */
    public $introduction;

    /**
     * 跳转链接
     */
    public $jump_url;

    /**
     * 回放拉流地址（含authkey）
     */
    public $replay_url;

    /**
     * 开始时间
     */
    public $start_time;

    /**
     * 课程状态
     */
    public $status;

    /**
     * 直播状态
     */
    public $sub_status;

    /**
     * 课程标题
     */
    public $title;
}
