<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class TaskUpdate
{
    /**
     * 任务所属项目(虚拟企业），基于项目空间的项目
     */
    public $corp_id;

    /**
     * 描述（传null不更新，传空串则清空原值）
     */
    public $description;

    /**
     * 执行者id（传null不更新，传空串则清空原值）
     */
    public $executor_userid;

    /**
     * 任务的扩展字段
     */
    public $extension;

    /**
     * 完成时间（传null不更新，传Date(0)，即1970-01-01T08:00:00.000+08:00则清空原值）
     */
    public $finish_date;

    /**
     * 修改时间
     */
    public $gmt_modified;

    /**
     * 是否归档
     */
    public $is_archived;

    /**
     * 是否放入回收站
     */
    public $is_recycled;

    /**
     * 更新者id
     */
    public $modifier_userid;

    /**
     * 父任务id
     */
    public $parent_id;

    /**
     * 计划结束时间（传null不更新，传Date(0)，即1970-01-01T08:00:00.000+08:00则清空原值）
     */
    public $plan_finish_date;

    /**
     * 计划开始时间（传null不更新，传Date(0)，即1970-01-01T08:00:00.000+08:00则清空原值）
     */
    public $plan_start_date;

    /**
     * 优先级
     */
    public $priority;

    /**
     * 任务来源source
     */
    public $source;

    /**
     * 来源id
     */
    public $source_id;

    /**
     * 开始日期（传null不更新，传Date(0)，即1970-01-01T08:00:00.000+08:00则清空原值）
     */
    public $start_date;

    /**
     * 工作流状态id
     */
    public $status_id;

    /**
     * 状态阶段: 开始阶段(0)，进行阶段(1)，完成阶段(2)
     */
    public $status_stage;

    /**
     * 标题
     */
    public $subject;

    /**
     * 任务类型分类:// 任务 TASK("task"),     // 需求     REQ("req"),     // 缺陷     BUG("bug"),     // 风险     RISK("risk"),     // 工作项     WORKITEM("workitem")
     */
    public $task_type_category;

    /**
     * 任务类型id
     */
    public $task_type_id;

    /**
     * 任务参与者列表
     */
    public $tracker_userids;
}
