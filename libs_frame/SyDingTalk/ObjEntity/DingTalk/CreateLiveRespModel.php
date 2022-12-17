<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 直播创建响应model
 *
 * @author auto create
 */
class CreateLiveRespModel
{
    /**
     * 预约直播时间
     */
    public $appointment_time;

    /**
     * 推流地址
     */
    public $input_stream_url;

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
     * 直播UUID
     */
    public $uuid;
}
