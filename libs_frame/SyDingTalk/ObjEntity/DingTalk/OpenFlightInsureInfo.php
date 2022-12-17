<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 保险信息
 *
 * @author auto create
 */
class OpenFlightInsureInfo
{
    /**
     * 保单号
     */
    public $insure_no;

    /**
     * 乘机人(保险人)姓名
     */
    public $name;

    /**
     * 状态：1已出保 2已退保
     */
    public $status;
}
