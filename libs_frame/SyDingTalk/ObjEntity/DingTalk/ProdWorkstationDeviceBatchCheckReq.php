<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * param_prod_workstation_device_batch_check_req
 *
 * @author auto create
 */
class ProdWorkstationDeviceBatchCheckReq
{
    /**
     * 设备id列表
     */
    public $device_ids;

    /**
     * 站位code
     */
    public $prod_workstation_code;

    /**
     * 租户ID
     */
    public $tenant_id;

    /**
     * 用户ID
     */
    public $userid;
}
