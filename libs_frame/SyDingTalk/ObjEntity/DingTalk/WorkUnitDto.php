<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 分配单元列表
 *
 * @author auto create
 */
class WorkUnitDto
{
    /**
     * 设备分配列表
     */
    public $device_assigns;

    /**
     * 人员分配列表
     */
    public $worker_assigns;

    /**
     * 站位分配
     */
    public $workstation_assigns;
}
