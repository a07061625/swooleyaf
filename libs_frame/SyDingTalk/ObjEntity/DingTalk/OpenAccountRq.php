<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求对象
 *
 * @author auto create
 */
class OpenAccountRq
{
    /**
     * 对账单月份，不传取最新对账单
     */
    public $bill_month;

    /**
     * 企业id
     */
    public $corpid;
}
