<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class UpdateProcessVisibleRequest
{
    /**
     * 企业应用id
     */
    public $agentid;

    /**
     * 流程模板processCode
     */
    public $process_code;

    /**
     * 操作人userId
     */
    public $userid;

    /**
     * 可见权限配置列表
     */
    public $visible_list;
}
