<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 动作列表
 *
 * @author auto create
 */
class TicketActionDto
{
    /**
     * 动作表单字段列表
     */
    public $action_content;

    /**
     * 执行人
     */
    public $operator;

    /**
     * 创建者1；客服 4；
     */
    public $operator_role;
}
