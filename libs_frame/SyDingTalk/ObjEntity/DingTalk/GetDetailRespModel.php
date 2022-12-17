<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 直播查询响应model
 *
 * @author auto create
 */
class GetDetailRespModel
{
    /**
     * 预约直播时间
     */
    public $appointment_time;

    /**
     * 直播计划开始时间
     */
    public $appt_begin_time;

    /**
     * 直播计划结束时间
     */
    public $appt_end_time;

    /**
     * 封面图,16:9长宽比
     */
    public $cover_url;

    /**
     * 直播结束时间
     */
    public $end_time;

    /**
     * 推流地址
     */
    public $input_stream_url;

    /**
     * 简介
     */
    public $intro;

    /**
     * 横竖屏:false 竖屏, true 横屏(默认)
     */
    public $land_scape;

    /**
     * 原始直播地址
     */
    public $live_url;

    /**
     * 转码直播地址
     */
    public $live_url_ext;

    /**
     * 原始HLS直播地址
     */
    public $live_url_hls;

    /**
     * 直播回放地址
     */
    public $playback_url;

    /**
     * 预告视频Url
     */
    public $pre_video_play_url;

    /**
     * 直播可观看类型类型:false 受限制的直播, true 公开的直播(默认)
     */
    public $shared;

    /**
     * 直播开始时间
     */
    public $start_time;

    /**
     * 直播间状态:0 预告, 1 直播中, 2 直播结束
     */
    public $status;

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
