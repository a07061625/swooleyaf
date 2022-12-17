<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果列表
 *
 * @author auto create
 */
class AdvancedServiceInstanceVo
{
    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 有效期结束时间
     */
    public $end_time;

    /**
     * 实体id
     */
    public $entity_id;

    /**
     * 实体类型，取值user, group, corp
     */
    public $entity_type;

    /**
     * 绑定关系id
     */
    public $id;

    /**
     * 是否删除，取值Y|N
     */
    public $is_deleted;

    /**
     * 绑定关系名称
     */
    public $name;

    /**
     * 服务id
     */
    public $service_id;

    /**
     * 有效期开始时间
     */
    public $start_time;
}
