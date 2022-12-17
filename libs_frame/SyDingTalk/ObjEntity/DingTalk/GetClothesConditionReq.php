<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class GetClothesConditionReq
{
    /**
     * 实体条件
     */
    public $condition;

    /**
     * 租户
     */
    public $order_id;

    /**
     * 页信息
     */
    public $page;

    /**
     * 尺码
     */
    public $size_codes;

    /**
     * 状态
     */
    public $status;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * user_id
     */
    public $userid;
}
