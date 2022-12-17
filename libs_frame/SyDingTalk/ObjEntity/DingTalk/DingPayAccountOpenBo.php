<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * accountOpenBO
 *
 * @author auto create
 */
class DingPayAccountOpenBo
{
    /**
     * 支付宝托管账户
     */
    public $anonymous_alipay_uid;

    /**
     * 企业corpId
     */
    public $corp_id;

    /**
     * 扩展属性
     */
    public $extension;

    /**
     * 支付宝资金账号列表
     */
    public $real_alipay_uids;

    /**
     * 当前使用的支付宝资金账号
     */
    public $real_used_alipay_uid;
}
