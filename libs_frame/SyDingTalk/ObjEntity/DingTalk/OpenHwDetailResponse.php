<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class OpenHwDetailResponse
{
    /**
     * 扩展属性
     */
    public $attributes;

    /**
     * 作业内容
     */
    public $hw_content;

    /**
     * 作业视频
     */
    public $hw_media;

    /**
     * 作业图片
     */
    public $hw_photo;

    /**
     * 作业状态
     */
    public $hw_status;

    /**
     * 作业标题
     */
    public $hw_title;

    /**
     * 作业录音
     */
    public $hw_video;

    /**
     * 是否定时作业
     */
    public $scheduled_release;

    /**
     * 定时发送事件
     */
    public $scheduled_time;

    /**
     * 发送时间
     */
    public $send_time;

    /**
     * 老师ID
     */
    public $teacher_id;

    /**
     * 老师姓名
     */
    public $teacher_name;
}
