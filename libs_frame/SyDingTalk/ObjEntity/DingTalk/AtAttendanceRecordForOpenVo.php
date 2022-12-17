<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打卡流水list
 *
 * @author auto create
 */
class AtAttendanceRecordForOpenVo
{
    /**
     * 基本定位精度
     */
    public $base_accuracy;

    /**
     * 打卡基础地质
     */
    public $base_address;

    /**
     * 流水无效的原因
     */
    public $invalid_record_msg;

    /**
     * 流水无效的类型
     */
    public $invalid_record_type;

    /**
     * 流水id
     */
    public $record_id;

    /**
     * 打卡来源
     */
    public $source_type;

    /**
     * 用户定位精度
     */
    public $user_accuracy;

    /**
     * 用户打卡时间
     */
    public $user_check_time;

    /**
     * 打卡纬度
     */
    public $user_latitude;

    /**
     * 打卡维度
     */
    public $user_longitude;

    /**
     * mac地址
     */
    public $user_mac_addr;

    /**
     * wifi名称
     */
    public $user_ssid;

    /**
     * 是否匹配
     */
    public $valid_matched;
}
