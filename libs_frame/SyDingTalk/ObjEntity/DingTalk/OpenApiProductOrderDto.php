<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 列表
 *
 * @author auto create
 */
class OpenApiProductOrderDto
{
    /**
     * 实际完成时间
     */
    public $actual_finish_time;

    /**
     * 实际开始时间
     */
    public $actual_start_time;

    /**
     * 数字工艺品类id
     */
    public $biz_id_dtech_category;

    /**
     * 数字工艺品类名称
     */
    public $biz_id_dtech_category_name;

    /**
     * 数字工艺包id
     */
    public $biz_id_dtech_pkg;

    /**
     * 颜色id
     */
    public $color_id;

    /**
     * 颜色名称
     */
    public $color_name;

    /**
     * 商家货号
     */
    public $goods_no;

    /**
     * 主键id
     */
    public $id;

    /**
     * 订单BP号
     */
    public $number;

    /**
     * 订单创建时间
     */
    public $order_create_time;

    /**
     * 计划完成时间
     */
    public $plan_finish_time;

    /**
     * 计划开始时间
     */
    public $plan_start_time;

    /**
     * 采购订单id
     */
    public $purchase_order_id;

    /**
     * TRADE/DCC/TRAIN - 订单来源
     */
    public $source;

    /**
     * 状态
     */
    public $status;

    /**
     * 款号
     */
    public $style_code;

    /**
     * 款式id
     */
    public $style_id;

    /**
     * 款式图片
     */
    public $style_img;

    /**
     * 款式名称
     */
    public $style_name;

    /**
     * 租户id
     */
    public $tenant_id;

    /**
     * 总数量
     */
    public $total_quantity;
}
