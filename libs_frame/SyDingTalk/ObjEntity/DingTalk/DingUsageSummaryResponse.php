<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果对象
 *
 * @author auto create
 */
class DingUsageSummaryResponse
{
    /**
     * 最近一天发送应用DING数
     */
    public $ding_app_cnt;

    /**
     * 最近一天发送应用DING人数
     */
    public $ding_app_user_cnt;

    /**
     * 最近一天发送电话DING数
     */
    public $ding_call_cnt;

    /**
     * 最近一天发送电话DING人数
     */
    public $ding_call_user_cnt;

    /**
     * 最近1天发送DING数
     */
    public $ding_cnt;

    /**
     * 最近一天发送短信DING数
     */
    public $ding_sms_cnt;

    /**
     * 最近一天发送短信DING人数
     */
    public $ding_sms_user_cnt;

    /**
     * 最近1天发送DING人数
     */
    public $ding_user_cnt;

    /**
     * 最近一天发送语音DING数
     */
    public $ding_voip_cnt;

    /**
     * 最近一天发送语音DING人数
     */
    public $ding_voip_user_cnt;
}
