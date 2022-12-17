<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 简历文件参数
 *
 * @author auto create
 */
class CollResumeMailParam
{
    /**
     * 渠道来源，接入前请提前沟通
     */
    public $channel;

    /**
     * 匹配到的职位列表
     */
    public $matched_jobs;

    /**
     * userId123
     */
    public $opt_user_id;

    /**
     * 原始邮件信息，可选
     */
    public $origin_mail;

    /**
     * 结构化的简历详情
     */
    public $resume_detail_info;

    /**
     * 简历文件信息
     */
    public $resume_file;
}
