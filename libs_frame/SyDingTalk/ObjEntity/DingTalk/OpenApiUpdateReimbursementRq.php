<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class OpenApiUpdateReimbursementRq
{
    /**
     * 申请单编号,如不做变更，请与创建报销单时保持一致
     */
    public $apply_flow_no;

    /**
     * 审批人列表
     */
    public $audit_list;

    /**
     * corp id
     */
    public $corpid;

    /**
     * 审批单号
     */
    public $flow_no;

    /**
     * 审批操作时间
     */
    public $operate_time;

    /**
     * 关联的报销订单id列表,<订单id:类型(机、酒、火、用车)>如不做变更，请与创建报销单时保持一致
     */
    public $order_ids;

    /**
     * 审批状态
     */
    public $status;

    /**
     * 第三方报销单id
     */
    public $thirdparty_flow_id;
}
