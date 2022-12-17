<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class ProcessForecastRequest
{
    /**
     * 应用id
     */
    public $agentid;

    /**
     * 表单数据
     */
    public $form_component_values;

    /**
     * 发起人所在部门
     */
    public $originator_deptid;

    /**
     * 发起人id
     */
    public $originator_userid;

    /**
     * 模板唯一码
     */
    public $process_code;
}
