<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class OperationPerformDto
{
    /**
     * 是否生效
     */
    public $active;

    /**
     * 批量id
     */
    public $batch_id;

    /**
     * 上下文
     */
    public $context;

    /**
     * 创建类型
     */
    public $create_type;

    /**
     * 设备id
     */
    public $device_ids;

    /**
     * 实体id
     */
    public $entity_id;

    /**
     * 实体类型
     */
    public $entity_type;

    /**
     * flow版本
     */
    public $flow_version;

    /**
     * 执行记录id
     */
    public $id;

    /**
     * 工序类型
     */
    public $operation_type;

    /**
     * 工序uid
     */
    public $operation_uid;

    /**
     * 订单id
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
     * 工序类型code
     */
    public $process_type_code;

    /**
     * 工序处理结束时间
     */
    public $processing_end_time;

    /**
     * 工序处理开始时间
     */
    public $processing_start_time;

    /**
     * 工段
     */
    public $section_code;

    /**
     * sourceId
     */
    public $source_id;

    /**
     * source类型
     */
    public $source_type;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 工号
     */
    public $work_nos;

    /**
     * 站位
     */
    public $workstation_code;
}
