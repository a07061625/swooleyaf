<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务参数
 *
 * @author auto create
 */
class BindParam
{
    /**
     * 有效期结束时间，时间戳
     */
    public $end_time;

    /**
     * 实体id
     */
    public $entity_id;

    /**
     * 实体类型，当前支持user,group,corp
     */
    public $entity_type;

    /**
     * 绑定名称
     */
    public $name;

    /**
     * 服务id
     */
    public $service_id;

    /**
     * 有效期开始时间，时间戳
     */
    public $start_time;
}
