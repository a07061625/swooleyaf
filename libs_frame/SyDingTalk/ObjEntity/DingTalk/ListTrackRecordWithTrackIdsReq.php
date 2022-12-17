<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class ListTrackRecordWithTrackIdsReq
{
    /**
     * 实体ID列表
     */
    public $entity_ids;

    /**
     * 实体类型
     */
    public $entity_type;

    /**
     * 分页
     */
    public $page;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 追踪类型
     */
    public $track_types;

    /**
     * 预留参数
     */
    public $userid;
}
