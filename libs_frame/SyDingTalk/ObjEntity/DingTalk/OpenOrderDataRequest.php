<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 排序因子
 *
 * @author auto create
 */
class OpenOrderDataRequest
{
    /**
     * 排序字段名；字段名详见返回字段
     */
    public $field_name;

    /**
     * 升序 asc; 降序 desc；
     */
    public $order;
}
