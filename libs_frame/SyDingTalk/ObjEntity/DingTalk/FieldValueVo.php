<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 字段值列表（明细分组字段包含多条、非明细分组仅一条记录）
 *
 * @author auto create
 */
class FieldValueVo
{
    /**
     * 标识第几条明细（下标从0开始）
     */
    public $item_index;

    /**
     * 字段展示值（选项类型字段对应选项的value）
     */
    public $label;

    /**
     * 字段取值（选项类型字段对应选项的key）
     */
    public $value;
}
