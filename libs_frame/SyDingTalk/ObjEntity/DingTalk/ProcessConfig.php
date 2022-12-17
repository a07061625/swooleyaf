<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 模板配置属性
 *
 * @author auto create
 */
class ProcessConfig
{
    /**
     * 是否在审批后台禁用删除操作
     */
    public $disable_delete_process;

    /**
     * 是否允许表单在审批管理后台可编辑。true表示不可以
     */
    public $disable_form_edit;

    /**
     * 是否在审批首页/工作台屏蔽模板
     */
    public $disable_homepage;

    /**
     * 是否在审批详情页禁用再次提交操作
     */
    public $disable_resubmit;

    /**
     * 是否在审批后台禁用停用操作
     */
    public $disable_stop_process_button;

    /**
     * 假流程模板编辑url
     */
    public $fake_template_edit_url;

    /**
     * 设置模板是否隐藏，true表示隐藏
     */
    public $hidden;

    /**
     * 审批模板编辑跳转页。当fake_mode为true时，此参数失效。
     */
    public $template_edit_url;
}
