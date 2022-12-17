<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 查询对象
 *
 * @author auto create
 */
class TicketPageQueryDto
{
    /**
     * 游标
     */
    public $cursor;

    /**
     * 结束时间
     */
    public $end_date;

    /**
     * 三方账号id
     */
    public $foreign_id;

    /**
     * 三方账号姓名
     */
    public $foreign_name;

    /**
     * 实例id
     */
    public $open_instance_id;

    /**
     * 1智能客服
     */
    public $production_type;

    /**
     * 分页大小
     */
    public $size;

    /**
     * 三方账号标识
     */
    public $source_id;

    /**
     * 开始时间
     */
    public $start_date;

    /**
     * 工单id
     */
    public $ticket_id;

    /**
     * 待受理
     */
    public $ticket_status;

    /**
     * 工单类型id
     */
    public $ticket_template_id;
}
