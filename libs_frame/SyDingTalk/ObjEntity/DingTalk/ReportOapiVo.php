<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 日志列表
 *
 * @author auto create
 */
class ReportOapiVo
{
    /**
     * 日志内容
     */
    public $contents;

    /**
     * 日志创建时间
     */
    public $create_time;

    /**
     * 日志创建人userid
     */
    public $creator_id;

    /**
     * 日志创建人
     */
    public $creator_name;

    /**
     * 部门
     */
    public $dept_name;

    /**
     * 备注
     */
    public $remark;

    /**
     * 日志唯一id
     */
    public $report_id;

    /**
     * 日志模板名
     */
    public $template_name;
}
