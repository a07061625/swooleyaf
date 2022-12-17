<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求
 *
 * @author auto create
 */
class AddForwardRequest
{
    /**
     * 应用id
     */
    public $agentid;

    /**
     * 实例id
     */
    public $process_instance_id;

    /**
     * 抄送人id列表
     */
    public $userid_list;
}
