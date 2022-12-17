<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class OpenApiUpdateAppStatusRq
{
    /**
     * corp id
     */
    public $corpid;

    /**
     * 是否已经安装（app是否正常提供服务）
     */
    public $installed;

    /**
     * isv 代码
     */
    public $isv_code;

    /**
     * app版本
     */
    public $version;
}
