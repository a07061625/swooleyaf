<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 规格列表
 *
 * @author auto create
 */
class OpenGoodsItemVo
{
    /**
     * 是否试用
     */
    public $is_try_outs;

    /**
     * 规格码
     */
    public $item_code;

    /**
     * 周期列表
     */
    public $item_cyc_list;

    /**
     * 规格名称
     */
    public $item_name;

    /**
     * 最大购买人数
     */
    public $max_num;

    /**
     * 最小购买人数
     */
    public $min_num;
}
