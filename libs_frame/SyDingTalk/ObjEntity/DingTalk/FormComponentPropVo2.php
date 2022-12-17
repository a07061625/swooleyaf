<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 子表单属性
 *
 * @author auto create
 */
class FormComponentPropVo2
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
     * 控件类型
     */
    public $biz_type;

    /**
     * 内部联系人choice，1表示多选，0表示单选
     */
    public $choice;

    /**
     * 自定义控件渲染类型
     */
    public $common_biz_type;

    /**
     * 说明文字
     */
    public $content;

    /**
     * 是否自动计算时长
     */
    public $duration;

    /**
     * 时间格式
     */
    public $format;

    /**
     * 暂不需要
     */
    public $formula;

    /**
     * 表单id
     */
    public $id;

    /**
     * 表单名称
     */
    public $label;

    /**
     * 说明文案的链接地址
     */
    public $link;

    /**
     * 是否参与打印(1表示不打印, 0表示打印)
     */
    public $not_print;

    /**
     * 是否需要大写 默认是需要; 1:不需要大写, 空或者0:需要大写
     */
    public $not_upper;

    /**
     * 单选框或者多选框的选项
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
     * 明细展示方式：表格 table、列表list
     */
    public $table_view_mode;

    /**
     * 数字组件/日期区间组件单位属性
     */
    public $unit;
}
