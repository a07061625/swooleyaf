<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class TelConferenceSummaryResponse
{
    /**
     * 呼叫成功次数
     */
    public $call_count;

    /**
     * 呼叫成功时长(秒)
     */
    public $call_duration;

    /**
     * 呼叫成功时长(分钟)
     */
    public $call_duration_min;

    /**
     * 呼叫参与人次
     */
    public $call_join_pv;
}
