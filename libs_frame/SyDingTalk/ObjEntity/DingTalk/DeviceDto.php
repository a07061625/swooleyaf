<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 符合条件的设备
 *
 * @author auto create
 */
class DeviceDto
{
    /**
     * 设备id
     */
    public $device_id;

    /**
     * 设备名称
     */
    public $name;

    /**
     * 在线是否在线
     */
    public $online;

    /**
     * 是否启用识别（查询已绑定记录时有效）
     */
    public $status;

    /**
     * 设备类型
     */
    public $type;

    /**
     * 是否已被使用（含被本组关联）
     */
    public $used;
}
