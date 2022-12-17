<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 根请求
 *
 * @author auto create
 */
class SaveFormSchemaRequest
{
    /**
     * 控件字符串
     */
    public $content;

    /**
     * 表单设置
     */
    public $custom_setting;

    /**
     * 控件对象
     */
    public $form_content;

    /**
     * 图标
     */
    public $icon;

    /**
     * 提示
     */
    public $memo;

    /**
     * 表单名称
     */
    public $name;

    /**
     * 可见范围
     */
    public $process_visible_list;

    /**
     * 用户id
     */
    public $userid;

    /**
     * 可识别是否加密的可见范围
     */
    public $visible_value_list;
}
