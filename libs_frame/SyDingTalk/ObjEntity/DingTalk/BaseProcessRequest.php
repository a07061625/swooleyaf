<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class BaseProcessRequest
{
    /**
     * 企业应用id
     */
    public $agentid;

    /**
     * 流程模板processcode
     */
    public $process_code;

    /**
     * 操作人userId
     */
    public $userid;
}
