<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 细码列表
 *
 * @author auto create
 */
class OpenApiProductOrderDetailDto
{
    /**
     * 主键id
     */
    public $id;

    /**
     * 生产订单id
     */
    public $product_order_id;

    /**
     * 数量
     */
    public $quantity;

    /**
     * 尺码id
     */
    public $size_id;

    /**
     * 尺码名称
     */
    public $size_name;

    /**
     * 租户id
     */
    public $tenant_id;
}
