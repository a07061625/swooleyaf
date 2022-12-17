<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * result
 *
 * @author auto create
 */
class AtCheckInfoForOpenVo
{
    /**
     * 审批单列表
     */
    public $approve_list;

    /**
     * 打卡结果list
     */
    public $attendance_result_list;

    /**
     * 打卡流水list
     */
    public $check_record_list;

    /**
     * 当前排班对应的休息时间段
     */
    public $class_setting_info;

    /**
     * 公司id
     */
    public $corp_id;

    /**
     * 用户id
     */
    public $userid;

    /**
     * 查询日期
     */
    public $work_date;
}
