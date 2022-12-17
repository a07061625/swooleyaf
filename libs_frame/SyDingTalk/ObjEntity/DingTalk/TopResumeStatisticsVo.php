<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 简历信息列表
 *
 * @author auto create
 */
class TopResumeStatisticsVo
{
    /**
     * 招聘业务标识
     */
    public $biz_code;

    /**
     * 候选人id
     */
    public $candidate_id;

    /**
     * lagou,51job,58tongcheng,zhilian,liepin,boss,other
     */
    public $channel;

    /**
     * 企业id
     */
    public $corp_id;

    /**
     * 创建时间，unix时间戳，单位毫秒
     */
    public $gmt_create_mils;

    /**
     * 更新时间，unix时间戳，单位毫秒
     */
    public $gmt_modified_mils;

    /**
     * 简历id
     */
    public $resume_id;
}
