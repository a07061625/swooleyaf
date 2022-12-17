<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class SaveFakeProcessInstanceRequest
{
    /**
     * 应用id
     */
    public $agentid;

    /**
     * 流程实例业务动作
     */
    public $biz_action;

    /**
     * 审批自定义数据
     */
    public $custom_data;

    /**
     * 表单参数列表
     */
    public $form_component_values;

    /**
     * 流程实例主单instId
     */
    public $main_instance_id;

    /**
     * 审批发起人
     */
    public $originator_user_id;

    /**
     * 审批模板唯一码
     */
    public $process_code;

    /**
     * 审批单评论
     */
    public $remark;

    /**
     * 实例标题
     */
    public $title;

    /**
     * 实例跳转链接
     */
    public $url;
}
