<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 结果
 *
 * @author auto create
 */
class IsvAuthCodeResult
{
    /**
     * 授权码有效期，unix时间戳，单位ms
     */
    public $expire_time;

    /**
     * 授权码
     */
    public $isv_code;
}
