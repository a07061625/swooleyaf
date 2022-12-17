<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 转码直播地址
 *
 * @author auto create
 */
class LiveUrlExtModel
{
    /**
     * 播放地址flv,超清-720p
     */
    public $live_url_high;

    /**
     * 播放地址flv,标清-360p
     */
    public $live_url_low;

    /**
     * 播放地址flv,高清-480p
     */
    public $live_url_normal;

    /**
     * 播放地址flv,极速
     */
    public $live_url_ultra_low;

    /**
     * 播放地址flv,流畅
     */
    public $live_url_very_low;
}
