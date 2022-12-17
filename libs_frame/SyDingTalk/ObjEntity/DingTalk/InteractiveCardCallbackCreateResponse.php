<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 业务返回结果
 *
 * @author auto create
 */
class InteractiveCardCallbackCreateResponse
{
    /**
     * api签名密钥
     */
    public $api_secret;

    /**
     * 业务回调地址
     */
    public $callback_url;
}
