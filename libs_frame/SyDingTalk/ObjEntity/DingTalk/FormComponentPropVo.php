<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 组件属性
 *
 * @author auto create
 */
class FormComponentPropVo
{
    /**
     * 考勤类型文案
     */
    public $attend_type_label;

    /**
     * 明细里的表单联动属性
     */
    public $behavior_linkage;

    /**
     * 业务别名, 当组件属于业务套件的一部分时方便业务识别(DDBizSuite)
     */
    public $biz_alias;

    /**
     * 业务套件类型(DDBizSuite)
     */
    public $biz_type;

    /**
     * 套件内子组件可见性，key为label，value=false不可见
     */
    public $child_field_visible;

    /**
     * 是否可编辑
     */
    public $disable;

    /**
     * 是否开启时长
     */
    public $duration;

    /**
     * 时长文案
     */
    public $duration_label;

    /**
     * 关联表单属性
     */
    public $fields_info;

    /**
     * 时间格式
     */
    public $format;

    /**
     * id
     */
    public $id;

    /**
     * 隐藏字段
     */
    public $invisible;

    /**
     * 标题
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
     * 选项列表
     */
    public $options;

    /**
     * 必填
     */
    public $required;

    /**
     * 明细里需要统计的字段
     */
    public $stat_field;
}
