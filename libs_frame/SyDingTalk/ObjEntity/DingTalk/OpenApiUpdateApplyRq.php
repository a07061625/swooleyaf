<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenApiUpdateApplyRq
{
    /**
     * 企业id
     */
    public $corpid;

    /**
     * 备注
     */
    public $note;

    /**
     * 操作时间
     */
    public $operate_time;

    /**
     * 1已同意 2已拒绝 3已转交 4已取消
     */
    public $status;

    /**
     * 外部申请单id
     */
    public $thirdpart_apply_id;

    /**
     * 审批人名字
     */
    public $user_name;

    /**
     * 审批人id
     */
    public $userid;
}
