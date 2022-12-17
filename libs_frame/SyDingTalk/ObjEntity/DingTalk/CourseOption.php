<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 课程选项信息
 *
 * @author auto create
 */
class CourseOption
{
    /**
     * 课堂模式：1/6/12（支持多少人上台）
     */
    public $online_mode;

    /**
     * 使用的平台：1（在线课堂）、2（在线课堂Pro）
     */
    public $platform;

    /**
     * 是否录制老师头像
     */
    public $record_avatar;
}
