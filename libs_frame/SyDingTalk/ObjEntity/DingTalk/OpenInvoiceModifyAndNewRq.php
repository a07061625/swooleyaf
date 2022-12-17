<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 入参
 *
 * @author auto create
 */
class OpenInvoiceModifyAndNewRq
{
    /**
     * 注册地址
     */
    public $address;

    /**
     * 开户行
     */
    public $bank_name;

    /**
     * 银行账号
     */
    public $bank_no;

    /**
     * 企业id
     */
    public $corpid;

    /**
     * 税号
     */
    public $tax_no;

    /**
     * 公司电话
     */
    public $tel;

    /**
     * 第三方发票id
     */
    public $third_part_id;

    /**
     * 发票抬头
     */
    public $title;

    /**
     * 类型，1:增值税普通发票,2:增值税专用发票
     */
    public $type;
}
