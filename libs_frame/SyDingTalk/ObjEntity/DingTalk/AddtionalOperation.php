<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工序信息
 *
 * @author auto create
 */
class AddtionalOperation
{
    /**
     * 上下文
     */
    public $context;

    /**
     * 设备ID列表
     */
    public $device_ids;

    /**
     * 排位布局版本
     */
    public $flow_version;

    /**
     * 工序类型
     */
    public $operation_type;

    /**
     * 工序ID
     */
    public $operation_uid;

    /**
     * 工序执行状态
     */
    public $perform_status;

    /**
     * 优先级
     */
    public $priority;

    /**
     * 工序执行完成时间
     */
    public $process_end_time;

    /**
     * 工序执行开始时间
     */
    public $process_start_time;

    /**
     * 工序能力类型
     */
    public $process_type_code;

    /**
     * 工段
     */
    public $section_code;

    /**
     * 执行人
     */
    public $work_nos;

    /**
     * 工位
     */
    public $workstation_code;
}
