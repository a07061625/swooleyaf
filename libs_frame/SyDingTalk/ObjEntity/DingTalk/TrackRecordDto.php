<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 追踪记录
 *
 * @author auto create
 */
class TrackRecordDto
{
    /**
     * 生效结束时间
     */
    public $effect_end_time;

    /**
     * 生效开始时间
     */
    public $effect_start_time;

    /**
     * 生效工位
     */
    public $effect_start_workstation_code;

    /**
     * 生效状态
     */
    public $effect_status;

    /**
     * 实体ID
     */
    public $entity_id;

    /**
     * 实体类型
     */
    public $entity_type;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 追踪ID
     */
    public $track_id;

    /**
     * 追踪类型
     */
    public $track_type;
}
