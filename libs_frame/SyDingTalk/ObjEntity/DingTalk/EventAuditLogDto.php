<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 记录列表
 *
 * @author auto create
 */
class EventAuditLogDto
{
    /**
     * 操作类型
     */
    public $action;

    /**
     * 文件id
     */
    public $biz_id;

    /**
     * 操作机器浏览器
     */
    public $browser;

    /**
     * 用户的钉钉id
     */
    public $ding_talk_id;

    /**
     * 用户所在企业中的员工id
     */
    public $emp_id;

    /**
     * 记录修改时间，unix时间戳，单位ms
     */
    public $gmt_create;

    /**
     * 操作机器ip
     */
    public $ip_address;

    /**
     * 操作者名字
     */
    public $operator_name;

    /**
     * 企业名称
     */
    public $org_name;

    /**
     * 操作端
     */
    public $platform;

    /**
     * 项目名称
     */
    public $project_name;

    /**
     * 文件接收方名称
     */
    public $receiver_name;

    /**
     * 文件名
     */
    public $resource;

    /**
     * 文件类型
     */
    public $resource_extension;

    /**
     * 文件大小
     */
    public $resource_size;

    /**
     * 任务名称
     */
    public $task_name;
}
