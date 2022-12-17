<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * data
 *
 * @author auto create
 */
class TelConferenceDetailVo
{
    /**
     * 会议id
     */
    public $conf_id;

    /**
     * 会议时长（分钟）
     */
    public $conf_len_min;

    /**
     * 发起人部门id
     */
    public $dept_id;

    /**
     * 发起人部门
     */
    public $dept_name;

    /**
     * 会议结束时间
     */
    public $end_time;

    /**
     * 参与人数
     */
    public $join_user_count;

    /**
     * 发起人工号
     */
    public $staff_job_num;

    /**
     * 发起人姓名
     */
    public $staff_name;

    /**
     * 会议开始时间
     */
    public $start_time;

    /**
     * 员工在当前企业内的唯一标识，也称staffId。可由企业在创建时指定，并代表一定含义比如工号，创建后不可修改
     */
    public $userid;
}
