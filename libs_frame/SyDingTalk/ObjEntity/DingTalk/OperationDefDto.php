<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工序定义图
 *
 * @author auto create
 */
class OperationDefDto
{
    /**
     * 适用尺码
     */
    public $applicable_size_code;

    /**
     * 是否需要调度
     */
    public $auto_schedule;

    /**
     * 业务编码
     */
    public $biz_code;

    /**
     * 业务来源
     */
    public $biz_source;

    /**
     * 进入条件：ANY_MATCH/ALL_MATCH
     */
    public $enter_condition;

    /**
     * 执行系统
     */
    public $exec_system;

    /**
     * PaaSflowID（只用于返回，保存会自增）
     */
    public $flow_id;

    /**
     * 工序定义版本
     */
    public $flow_version;

    /**
     * 工序名称
     */
    public $name;

    /**
     * 后续工序外部ID列表
     */
    public $next_operation_external_ids;

    /**
     * 后续工序唯一ID列表
     */
    public $next_operation_uids;

    /**
     * 工序执行器分配
     */
    public $operation_executor_assigns;

    /**
     * 工序外部ID
     */
    public $operation_external_id;

    /**
     * 工序类型：ASSIST/QUALITY_INSPECT/TECHNOLOGY
     */
    public $operation_type;

    /**
     * 工序唯一ID
     */
    public $operation_uid;

    /**
     * 工序能力类型：SJ/PP/TR等
     */
    public $process_type_code;

    /**
     * 工段CODE：F-SL/C..
     */
    public $section_code;

    /**
     * 工段名称：缝制-碎料/裁床..
     */
    public $section_name;

    /**
     * 是否跳过(不生产)
     */
    public $skip;

    /**
     * 标准工时/秒
     */
    public $std_cost;

    /**
     * 分配单元列表
     */
    public $work_units;
}
