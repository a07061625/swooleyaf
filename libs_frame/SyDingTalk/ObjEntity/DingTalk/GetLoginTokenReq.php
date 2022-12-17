<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 获取免登token请求
 *
 * @author auto create
 */
class GetLoginTokenReq
{
    /**
     * 渠道类型
     */
    public $channel;

    /**
     * 二方账号
     */
    public $id;
}
