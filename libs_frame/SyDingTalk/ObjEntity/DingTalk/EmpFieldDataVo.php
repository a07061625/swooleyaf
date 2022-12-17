<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 字段信息列表
 *
 * @author auto create
 */
class EmpFieldDataVo
{
    /**
     * 字段标识
     */
    public $field_code;

    /**
     * 字段名称
     */
    public $field_name;

    /**
     * 字段值列表（明细分组字段包含多条、非明细分组仅一条记录）
     */
    public $field_value_list;

    /**
     * 分组标识
     */
    public $group_id;
}
