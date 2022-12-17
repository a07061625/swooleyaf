<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * request
 *
 * @author auto create
 */
class SpacePoiUpsertReq
{
    /**
     * 类目code
     */
    public $category_code;

    /**
     * 类目子code
     */
    public $category_sub_code;

    /**
     * 兴趣点code
     */
    public $poi_code;

    /**
     * 兴趣点name
     */
    public $poi_name;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * userid
     */
    public $userid;
}
