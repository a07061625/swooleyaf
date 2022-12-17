<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分页查询结果
 *
 * @author auto create
 */
class PlayBackModel
{
    /**
     * 封面图
     */
    public $cover_url;

    /**
     * 直播结束时间
     */
    public $end_time;

    /**
     * 简介
     */
    public $intro;

    /**
     * 横竖屏: false 竖屏, true 横屏(默认)
     */
    public $land_scape;

    /**
     * 回放地址
     */
    public $playback_url;

    /**
     * 直播可观看类型: false 受限制的直播, true 公开的直播(默认)
     */
    public $shared;

    /**
     * 直播开始时间
     */
    public $start_time;

    /**
     * 直播时长
     */
    public $time_length;

    /**
     * 标题
     */
    public $title;

    /**
     * 总共参加人数,UV
     */
    public $total_join_count;

    /**
     * 总共访问次数,PV
     */
    public $total_view_count;

    /**
     * 别名
     */
    public $user_nick;

    /**
     * 主播ID
     */
    public $userid;

    /**
     * 直播UUID
     */
    public $uuid;
}
