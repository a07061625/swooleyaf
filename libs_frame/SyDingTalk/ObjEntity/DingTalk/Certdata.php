<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 认证明细
 *
 * @author auto create
 */
class Certdata
{
    /**
     * 当前认证考试是否可以参加。true：可以；false：敬请期待；
     */
    public $can_cert;

    /**
     * 认证等级。0:没有认证；1:初级；2:中级；3:高级；
     */
    public $cert_level;

    /**
     * 当前等级认证状态。0:未获取；1:认证中；2:证书制作中；3:已获取
     */
    public $cert_status;
}
