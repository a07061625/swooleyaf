<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 解绑参数
 * @author auto create
 */
class DeviceUnbindVo
{
    
    /**
     * 设备id，和设备名称不能同时为空
     **/
    public $device_id;
    
    /**
     * 设备名称，和设备id不能同时为空
     **/
    public $device_name;
    
    /**
     * 产品标识
     **/
    public $pk;
    
    /**
     * 操作者id
     **/
    public $userid;
}
