<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class ProdWorkstationWorkerCheckDto
{
    /**
     * 登入时间
     */
    public $check_in_time;

    /**
     * 登出时间
     */
    public $check_out_time;

    /**
     * 登入登出状态
     */
    public $check_status;

    /**
     * 站位code
     */
    public $prod_workstation_code;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 工号
     */
    public $work_no;
}
