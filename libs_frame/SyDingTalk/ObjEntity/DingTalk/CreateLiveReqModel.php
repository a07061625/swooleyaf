<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 直播创建请求model
 *
 * @author auto create
 */
class CreateLiveReqModel
{
    /**
     * 直播计划开始时间,选填: 如果不填写, 则取当前时间
     */
    public $appt_begin_time;

    /**
     * 直播计划结束时间,选填
     */
    public $appt_end_time;

    /**
     * 封面图,选填: 如果不填写, 则采用默认
     */
    public $cover_url;

    /**
     * 简介,选填
     */
    public $intro;

    /**
     * 横竖屏,选填: false 竖屏, true 横屏(默认)
     */
    public $land_scape;

    /**
     * 预告视频Url,选填
     */
    public $pre_video_play_url;

    /**
     * 直播可观看类型类型,必填: false 受限制的直播, true 公开的直播(默认)
     */
    public $shared;

    /**
     * 标题,必填
     */
    public $title;

    /**
     * 别名,选填
     */
    public $user_nick;

    /**
     * 主播ID,必填
     */
    public $userid;
}
