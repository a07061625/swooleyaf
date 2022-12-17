<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工单列表
 *
 * @author auto create
 */
class TicketBaseDto
{
    /**
     * 新建时间
     */
    public $gmt_create;

    /**
     * 最新修改时间
     */
    public $gmt_modified;

    /**
     * 模板id
     */
    public $template_id;

    /**
     * 工单id
     */
    public $ticket_id;

    /**
     * 工单状态
     */
    public $ticket_status;

    /**
     * 工单标题
     */
    public $title;
}
