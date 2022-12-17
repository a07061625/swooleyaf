<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参，创建报销单参数
 *
 * @author auto create
 */
class OpenApiNewReimbursementRq
{
    /**
     * 申请单编号
     */
    public $apply_flow_no;

    /**
     * 审批列表
     */
    public $audit_list;

    /**
     * corp id
     */
    public $corpid;

    /**
     * 部门ID，不填时取用户所在部门id
     */
    public $depart_id;

    /**
     * 部门名称，不填时取用户所在部门id
     */
    public $depart_name;

    /**
     * 报销单详情
     */
    public $detail_url;

    /**
     * isv标识
     */
    public $isv_code;

    /**
     * 报销人
     */
    public $operator;

    /**
     * 关联的报销订单id列表,<订单id:类型(机、酒、火、用车)>
     */
    public $order_ids;

    /**
     * 报销金额
     */
    public $pay_amount;

    /**
     * 状态  0：审批中，1：已同意，2：已拒绝，4：已撤销
     */
    public $status;

    /**
     * 第三方流程id
     */
    public $thirdparty_flow_id;

    /**
     * 报销单标题
     */
    public $title;
}
