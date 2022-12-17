<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 调用结果
 *
 * @author auto create
 */
class OrderTagDto
{
    /**
     * bom是否ready
     */
    public $bom_ready;

    /**
     * 是否为2C订单
     */
    public $customize_order;

    /**
     * embroidery是否ready
     */
    public $embroidery_ready;

    /**
     * 商家货号
     */
    public $goods_no;

    /**
     * 唛架包是否ready
     */
    public $marker_ready;

    /**
     * 是否不需要BOM,除非明确设置为true，否则均为false
     */
    public $no_bom;

    /**
     * 是否不需要GSD,除非明确设置为true，否则均为false
     */
    public $no_gsd;

    /**
     * 是否不需要laser,除非明确设置为true，否则均为false
     */
    public $no_laser;

    /**
     * 是否不需要唛架,除非明确设置为true，否则均为false
     */
    public $no_marker;

    /**
     * 是否需要跳过sap,除非明确设置为true,否则均不跳过
     */
    public $skip_sap;

    /**
     * 是否跳过供应链相关,除非明确设置为true，否则均不跳过
     */
    public $skip_supply_chain;
}
