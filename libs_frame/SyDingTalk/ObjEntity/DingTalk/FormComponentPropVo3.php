<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 控件属性
 *
 * @author auto create
 */
class FormComponentPropVo3
{
    /**
     * 套件是否开启异步获取分条件规则
     */
    public $async_condition;

    /**
     * 控件别名
     */
    public $biz_alias;

    /**
     * 内部联系人choice，1表示多选，0表示单选
     */
    public $choice;

    /**
     * 是否自动计算时长
     */
    public $duration;

    /**
     * 时间格式
     */
    public $format;

    /**
     * 计算公式
     */
    public $formula;

    /**
     * 控件id
     */
    public $id;

    /**
     * 控件名称
     */
    public $label;

    /**
     * 是否参与打印(1表示不打印, 0表示打印)
     */
    public $not_print;

    /**
     * 是否需要大写 默认是需要; 1:不需要大写, 空或者0:需要大写
     */
    public $not_upper;

    /**
     * 选项
     */
    public $options;

    /**
     * 占位提示（仅输入类组件）
     */
    public $placeholder;

    /**
     * 是否必填
     */
    public $required;

    /**
     * 数字组件/日期区间组件单位属性
     */
    public $unit;
}
