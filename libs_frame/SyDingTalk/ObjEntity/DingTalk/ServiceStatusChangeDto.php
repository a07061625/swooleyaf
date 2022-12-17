<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 系统自动生成
 *
 * @author auto create
 */
class ServiceStatusChangeDto
{
    /**
     * 客服所在bu
     */
    public $bu_id;

    /**
     * 钉钉的企业id
     */
    public $ding_corp_id;

    /**
     * 实例id
     */
    public $open_instance_id;

    /**
     * 原始状态
     */
    public $origin_status;

    /**
     * 1，智能客服；1001，经济体版本
     */
    public $production_type;

    /**
     * 客服id
     */
    public $service_id;

    /**
     * 客服所在系统
     */
    public $source;

    /**
     * 目标状态
     */
    public $target_status;
}
