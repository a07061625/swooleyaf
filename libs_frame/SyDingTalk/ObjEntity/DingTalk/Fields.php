<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 字段列表
 *
 * @author auto create
 */
class Fields
{
    /**
     * 是否自定义字段
     */
    public $customized;

    /**
     * 日期格式
     */
    public $format;

    /**
     * 字段展示名
     */
    public $label;

    /**
     * 字段名称
     */
    public $name;

    /**
     * 是否可空
     */
    public $nillable;

    /**
     * 是否引用关联
     */
    public $quote;

    /**
     * 引用的关联对象的字段列表
     */
    public $reference_fields;

    /**
     * 关联对象名称
     */
    public $reference_to;

    /**
     * 对MasterDetail类型有效：roll-up summary字段列表
     */
    public $roll_up_summary_fields;

    /**
     * 选项列表
     */
    public $select_options;

    /**
     * 字段类型
     */
    public $type;

    /**
     * 日期单位/金额单位
     */
    public $unit;
}
