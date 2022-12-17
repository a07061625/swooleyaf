<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 控件属性
 *
 * @author auto create
 */
class ComponentPropVo
{
    /**
     * 选项级联属性
     */
    public $behavior_linkage;

    /**
     * 系统别名
     */
    public $biz_alias;

    /**
     * 矩阵表单组件列定义
     */
    public $cols;

    /**
     * 控件id
     */
    public $id;

    /**
     * 标签
     */
    public $label;

    /**
     * 带选项的组件的option
     */
    public $options;

    /**
     * 占位符
     */
    public $placeholder;

    /**
     * 是否必填
     */
    public $required;

    /**
     * 矩阵表单组件行定义
     */
    public $rows;
}
