<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * data
 *
 * @author auto create
 */
class DingUsageDeptSummaryVo
{
    /**
     * 部门id
     */
    public $dept_id;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 最近一天发送应用ding数量
     */
    public $ding_app_cnt;

    /**
     * 最近一天发送应用ding人数
     */
    public $ding_app_user_cnt;

    /**
     * 最近一天发送电话ding数量
     */
    public $ding_call_cnt;

    /**
     * 最近一天发送电话ding人数
     */
    public $ding_call_user_cnt;

    /**
     * 最近一天发送ding的数量
     */
    public $ding_cnt;

    /**
     * 最近一天发送短信ding数量
     */
    public $ding_sms_cnt;

    /**
     * 最近一天发送短信ding人数
     */
    public $ding_sms_user_cnt;

    /**
     * 最近一天发送ding的人数
     */
    public $ding_user_cnt;

    /**
     * 最近一天发送语音ding数量
     */
    public $ding_voip_cnt;

    /**
     * 最近一天发送语音ding人数
     */
    public $ding_voip_user_cnt;

    /**
     * 历史累计发钉数
     */
    public $send_ding_total_cnt;
}
