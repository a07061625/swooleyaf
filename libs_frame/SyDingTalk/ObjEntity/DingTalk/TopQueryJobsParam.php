<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询参数
 *
 * @author auto create
 */
class TopQueryJobsParam
{
    /**
     * 是否校招
     */
    public $campus;

    /**
     * 创建人员工标识列表
     */
    public $creator_user_ids;

    /**
     * 更新时间的查询结束时间
     */
    public $end_modified_time;

    /**
     * 职位标识列表
     */
    public $job_ids;

    /**
     * 职位性质
     */
    public $job_nature;

    /**
     * 关联会话标识
     */
    public $open_conversation_id;

    /**
     * 更新时间的查询起始时间
     */
    public $start_modified_time;

    /**
     * 职位状态列表，1表示启用中，2表示关闭
     */
    public $status_list;
}
