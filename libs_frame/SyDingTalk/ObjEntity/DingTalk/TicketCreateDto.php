<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 工单对象
 *
 * @author auto create
 */
class TicketCreateDto
{
    /**
     * 第三方会员id
     */
    public $foreign_id;

    /**
     * 第三方会员名
     */
    public $foreign_name;

    /**
     * 实例id
     */
    public $open_instance_id;

    /**
     * 1智能客服产品
     */
    public $production_type;

    /**
     * 工单表单
     */
    public $properties;

    /**
     * 会员标识
     */
    public $source_id;

    /**
     * 工单模板id
     */
    public $template_id;

    /**
     * 工单标题
     */
    public $title;
}
