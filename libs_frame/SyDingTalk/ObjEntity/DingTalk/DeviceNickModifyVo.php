<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 昵称修改参数
 *
 * @author auto create
 */
class DeviceNickModifyVo
{
    /**
     * 设备id，和设备名称不能同时为空
     */
    public $device_id;

    /**
     * 设备名称，和设备id不能同时为空
     */
    public $device_name;

    /**
     * 新的昵称
     */
    public $nick;

    /**
     * 产品标识
     */
    public $pk;
}
