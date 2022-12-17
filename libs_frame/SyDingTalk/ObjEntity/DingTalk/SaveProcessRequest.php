<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class SaveProcessRequest
{
    /**
     * 企业应用id
     */
    public $agentid;

    /**
     * 发起审批移动端链接
     */
    public $create_instance_mobile_url;

    /**
     * 发起审批pc链接
     */
    public $create_instance_pc_url;

    /**
     * 审批模板描述
     */
    public $description;

    /**
     * 分组id
     */
    public $dir_id;

    /**
     * 废弃，请使用process_config.disable_form_edit字段
     */
    public $disable_form_edit;

    /**
     * true
     */
    public $disable_stop_process_button;

    /**
     * true表示不带流程的模板
     */
    public $fake_mode;

    /**
     * 表单列表
     */
    public $form_component_list;

    /**
     * 废弃，请使用process_config.hidden字段
     */
    public $hidden;

    /**
     * icon
     */
    public $icon;

    /**
     * 审批模板名称
     */
    public $name;

    /**
     * 原分组id
     */
    public $origin_dir_id;

    /**
     * 审批模板唯一码
     */
    public $process_code;

    /**
     * 模板配置属性
     */
    public $process_config;

    /**
     * 废弃，请使用process_config.template_edit_url字段
     */
    public $template_edit_url;
}
