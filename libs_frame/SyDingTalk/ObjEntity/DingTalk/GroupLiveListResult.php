<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 直播列表
 *
 * @author auto create
 */
class GroupLiveListResult
{
    /**
     * 直播时长
     */
    public $duration;

    /**
     * 直播id
     */
    public $live_uuid;

    /**
     * true为被联播群，false为主群
     */
    public $share_from;

    /**
     * 直播开始时间
     */
    public $start_time;

    /**
     * 直播标题
     */
    public $title;

    /**
     * 主播userId
     */
    public $userid;
}
