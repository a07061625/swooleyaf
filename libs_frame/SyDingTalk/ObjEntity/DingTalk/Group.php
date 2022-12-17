<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 考勤组
 *
 * @author auto create
 */
class Group
{
    /**
     * 是否开启拍照打卡，默认false
     */
    public $enable_camera_check;

    /**
     * 是否开启美颜，默认false
     */
    public $enable_face_beauty;

    /**
     * 是否开启笑脸打卡(若开启笑脸则默认开启拍照打卡)，默认false
     */
    public $enable_face_check;

    /**
     * 扩展字段，JSON格式
     */
    public $ext;

    /**
     * 考勤组id
     */
    public $group_key;

    /**
     * 打卡范围，单位：米
     */
    public $location_offset;

    /**
     * 考勤组名称
     */
    public $name;
}
