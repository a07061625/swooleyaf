<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class ProcessInstanceTopVo
{
    /**
     * 审批人列表
     */
    public $approver_userid_list;

    /**
     * 流程实例业务编号
     */
    public $business_id;

    /**
     * 抄送人列表
     */
    public $cc_userid_list;

    /**
     * 开始时间
     */
    public $create_time;

    /**
     * 结束时间
     */
    public $finish_time;

    /**
     * 审批表单变量组
     */
    public $form_component_values;

    /**
     * 发起人部门id
     */
    public $originator_dept_id;

    /**
     * 发起人userid
     */
    public $originator_userid;

    /**
     * 审批实例id
     */
    public $process_instance_id;

    /**
     * 审批结果，分为agree和refuse
     */
    public $process_instance_result;

    /**
     * 审批状态，分为NEW（刚创建）|RUNNING（运行中）|TERMINATED（被终止）|COMPLETED（完成）|CANCELED（取消）
     */
    public $status;

    /**
     * 标题
     */
    public $title;
}
