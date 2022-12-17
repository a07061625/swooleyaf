<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class TopResourceKmsConfig
{
    /**
     * 企业内部应用id
     */
    public $agentid;

    /**
     * 扩展字段,json格式
     */
    public $extension;

    /**
     * 请求id
     */
    public $requestid;

    /**
     * 资源路径
     */
    public $resource;

    /**
     * 轮转周期
     */
    public $rotate_period_day;
}
