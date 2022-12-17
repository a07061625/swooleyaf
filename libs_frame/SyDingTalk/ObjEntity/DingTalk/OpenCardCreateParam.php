<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 参数
 *
 * @author auto create
 */
class OpenCardCreateParam
{
    /**
     * 业务code
     */
    public $card_bizcode;

    /**
     * 卡片的具体信息
     */
    public $data;

    /**
     * 创建打卡的请求ID
     */
    public $identifier;

    /**
     * 前端版本
     */
    public $jsversion;

    /**
     * 内容来源,需要注册
     */
    public $sourcetype;

    /**
     * 当前登录的 staffId
     */
    public $userid;
}
