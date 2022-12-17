<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 会话目标
 *
 * @author auto create
 */
class SessionTargetDTO
{
    /**
     * 业务单元id
     */
    public $bu_id;

    /**
     * 钉钉的corpId
     */
    public $ding_corp_id;

    /**
     * 实例的id
     */
    public $open_instance_id;

    /**
     * 1，智能客服；1001，经济体版本
     */
    public $production_type;

    /**
     * 服务编号
     */
    public $service_id;

    /**
     * 会话来源
     */
    public $session_source;
}
