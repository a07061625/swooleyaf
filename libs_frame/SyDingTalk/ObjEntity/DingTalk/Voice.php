<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 语音消息
 *
 * @author auto create
 */
class Voice
{
    /**
     * 正整数，小于60，表示音频时长
     */
    public $duration;

    /**
     * 媒体文件id。2MB，播放长度不超过60s，AMR格式
     */
    public $media_id;
}
