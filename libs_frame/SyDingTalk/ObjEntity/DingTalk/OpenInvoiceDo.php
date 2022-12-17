<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 发票对象
 *
 * @author auto create
 */
class OpenInvoiceDo
{
    /**
     * 商旅发票id
     */
    public $id;

    /**
     * 发票类型：1:增值税普通发票 2：增值税专用发票
     */
    public $invoice_type;

    /**
     * 发票抬头
     */
    public $title;
}
