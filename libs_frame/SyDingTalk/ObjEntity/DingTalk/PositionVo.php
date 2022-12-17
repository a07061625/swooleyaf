<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 位置列表
 *
 * @author auto create
 */
class PositionVo
{
    /**
     * 位置唯一标识，根据type不同类型不同，如硬件类型代表硬件设备唯一标识
     */
    public $position_id;

    /**
     * 位置名称
     */
    public $position_name;

    /**
     * 位置类型，如100代表硬件B1设备
     */
    public $type;
}
