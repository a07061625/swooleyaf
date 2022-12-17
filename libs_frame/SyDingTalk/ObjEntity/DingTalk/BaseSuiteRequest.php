<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求入参
 *
 * @author auto create
 */
class BaseSuiteRequest
{
    /**
     * 业务请求标识
     */
    public $action_type;

    /**
     * 企业应用id
     */
    public $agentid;

    /**
     * 套件业务标识
     */
    public $biz_type;

    /**
     * 表单数据列表
     */
    public $form_data_list;

    /**
     * 流程processCode
     */
    public $process_code;

    /**
     * 请求唯一标识
     */
    public $seq_id;

    /**
     * 操作人userId
     */
    public $userid;
}
