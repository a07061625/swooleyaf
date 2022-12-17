<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 导出请求对象
 *
 * @author auto create
 */
class UnionExportParam
{
    /**
     * 业务唯一id，用于唯一标记一次导出，该参数多次请求幂等处理
     */
    public $biz_unique_id;

    /**
     * 失效策略(0上传后10分钟失效，1下载一次后失效)
     */
    public $expire_strategy;

    /**
     * 文件名
     */
    public $file_name;

    /**
     * top上传文件后的mediaId
     */
    public $media_id;

    /**
     * 权限策略(0谁发起谁下载)
     */
    public $permission_strategy;

    /**
     * 员工id
     */
    public $userid;
}
