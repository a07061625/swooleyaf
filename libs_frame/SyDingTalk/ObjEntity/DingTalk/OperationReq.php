<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工序执行记录
 *
 * @author auto create
 */
class OperationReq
{
    /**
     * 执行上下文
     */
    public $context;

    /**
     * 设备ID列表
     */
    public $device_ids;

    /**
     * 实体ID
     */
    public $entity_id;

    /**
     * 实体类型
     */
    public $entity_type;

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
     * 订单ID
     */
    public $order_id;

    /**
     * 执行状态
     */
    public $perform_status;

    /**
     * 执行类型
     */
    public $perform_type;

    /**
     * 优先级
     */
    public $priority;

    /**
     * 工序执行耗时，单位秒
     */
    public $process_cost_time;

    /**
     * 执行完成时间
     */
    public $process_end_time;

    /**
     * 执行开始时间
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
     * 来源ID
     */
    public $source_id;

    /**
     * 来源类型
     */
    public $source_type;

    /**
     * 执行人工号
     */
    public $work_nos;

    /**
     * 执行工位
     */
    public $workstation_code;
}
