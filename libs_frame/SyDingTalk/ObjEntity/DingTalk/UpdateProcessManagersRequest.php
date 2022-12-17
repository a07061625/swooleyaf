<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class UpdateProcessManagersRequest
{
    /**
     * 企业应用id
     */
    public $agentid;

    /**
     * 管理员列表
     */
    public $manager_list;

    /**
     * 流程模板processCode
     */
    public $process_code;

    /**
     * 操作人userId
     */
    public $userid;
}
