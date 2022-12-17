<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 删除子账号入参
 *
 * @author auto create
 */
class DelSubAccountReq
{
    /**
     * 主账号id
     */
    public $adminaccount_id;

    /**
     * 业务方channel
     */
    public $channel;

    /**
     * 子账号id
     */
    public $subaccount_id;
}
