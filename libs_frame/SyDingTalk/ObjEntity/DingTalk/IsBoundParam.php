<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务参数
 *
 * @author auto create
 */
class IsBoundParam
{
    /**
     * 实体id列表
     */
    public $entity_ids;

    /**
     * 实体类型，可取值user,group,corp
     */
    public $entity_type;

    /**
     * 服务id
     */
    public $service_id;
}
