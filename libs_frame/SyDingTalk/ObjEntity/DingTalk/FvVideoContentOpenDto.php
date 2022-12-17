<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 视频内容
 *
 * @author auto create
 */
class FvVideoContentOpenDto
{
    /**
     * 视频比特率
     */
    public $bitrate;

    /**
     * 视频播放时长，单位秒
     */
    public $duration;

    /**
     * 视频名字
     */
    public $file_name;

    /**
     * 视频文件大小
     */
    public $file_size;

    /**
     * 视频类型
     */
    public $file_type;

    /**
     * 视频高度
     */
    public $height;

    /**
     * 视频封面图url或通过钉盘接口上传获得的mediaId
     */
    public $pic_media_id;

    /**
     * 视频url或通过钉盘接口上传获得的mediaId
     */
    public $video_media_id;

    /**
     * 视频宽度
     */
    public $width;
}
