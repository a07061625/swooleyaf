<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class NewProcessInstanceTopVo
{
    /**
     * 审批人
     */
    public $approver_userids;

    /**
     * 审批附属实例列表，当已经通过的审批实例被修改或撤销，会生成一个新的实例，作为原有审批实例的附属。如果想知道当前已经通过的审批实例的状态，可以依次遍历它的附属列表，查询里面每个实例的biz_action
     */
    public $attached_process_instance_ids;

    /**
     * 审批实例业务动作,MODIFY表示该审批实例是基于原来的实例修改而来，REVOKE表示该审批实例是由原来的实例撤销后重新发起的,NONE表示正常发起
     */
    public $biz_action;

    /**
     * 审批实例业务编号
     */
    public $business_id;

    /**
     * 抄送人
     */
    public $cc_userids;

    /**
     * 开始时间
     */
    public $create_time;

    /**
     * 结束时间
     */
    public $finish_time;

    /**
     * formValueVOS
     */
    public $form_values;

    /**
     * operationRecords
     */
    public $operation_records;

    /**
     * 发起部门
     */
    public $originator_dept_id;

    /**
     * 发起部门
     */
    public $originator_dept_name;

    /**
     * 发起人
     */
    public $originator_userid;

    /**
     * 审批表单唯一标示
     */
    public $process_code;

    /**
     * 审批结果，分为agree和refuse
     */
    public $result;

    /**
     * 审批状态，分为NEW（刚创建）|RUNNING（运行中）|TERMINATED（被终止）|COMPLETED（完成）|CANCELED（取消）
     */
    public $status;

    /**
     * tasks
     */
    public $tasks;

    /**
     * 审批实例标题
     */
    public $title;
}
