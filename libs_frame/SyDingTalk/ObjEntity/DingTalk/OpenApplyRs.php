<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 审批单对象
 *
 * @author auto create
 */
class OpenApplyRs
{
    /**
     * 商旅审批展示id
     */
    public $apply_show_id;

    /**
     * 审批人列表
     */
    public $approver_list;

    /**
     * 企业名称
     */
    public $corp_name;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 部门名称
     */
    public $dept_name;

    /**
     * 部门id
     */
    public $deptid;

    /**
     * 外部出行人列表
     */
    public $external_traveler_list;

    /**
     * 创建时间
     */
    public $gmt_create;

    /**
     * 更新时间
     */
    public $gmt_modified;

    /**
     * 商旅审批单id
     */
    public $id;

    /**
     * 行程列表
     */
    public $itinerary_list;

    /**
     * 申请单状态：0申请 1同意 2拒绝 3转交 4取消 5修改已同意 6撤销已同意 7修改审批中 8已同意(修改被拒绝) 9撤销审批中 10已同意(撤销被拒绝) 11已同意(修改被取消) 12已同意(撤销被取消)
     */
    public $status;

    /**
     * 审批单状态描述
     */
    public $status_desc;

    /**
     * 第三方审批单id,如果非第三方审批单则为空
     */
    public $thirdpart_id;

    /**
     * 出行人列表
     */
    public $traveler_list;

    /**
     * 出差事由
     */
    public $trip_cause;

    /**
     * 出差天数
     */
    public $trip_day;

    /**
     * 审批单标题
     */
    public $trip_title;

    /**
     * 申请单提交类型 1：代提交 2：本人提交 注意：当申请单为代提交时，申请单提交人自己无法为自己下单
     */
    public $type;

    /**
     * 第三方关联单号
     */
    public $union_no;

    /**
     * 用户名称
     */
    public $user_name;

    /**
     * 用户id
     */
    public $userid;
}
