<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class TopKMSMeta
{
    /**
     * 微应用id
     */
    public $appid;

    /**
     * kms数据域名
     */
    public $endpoint;

    /**
     * 扩展字段,JSON格式
     */
    public $extension;

    /**
     * 请求id
     */
    public $requestid;

    /**
     * 0：禁用，1：启用
     */
    public $status;
}
