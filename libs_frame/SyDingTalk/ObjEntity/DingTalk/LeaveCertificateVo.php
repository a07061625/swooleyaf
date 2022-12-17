<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请假证明类
 *
 * @author auto create
 */
class LeaveCertificateVo
{
    /**
     * 超过多长时间需提供请假证明
     */
    public $duration;

    /**
     * 是否开启请假证明
     */
    public $enable;

    /**
     * 请假提示文案
     */
    public $prompt_information;

    /**
     * 请假证明单位hour，day
     */
    public $unit;
}
