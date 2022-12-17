<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 请求参数
 *
 * @author auto create
 */
class TopEncryptBoxStatus
{
    /**
     * 微应用的id
     */
    public $appid;

    /**
     * 组织的id
     */
    public $corp_id;

    /**
     * 附加信息，方便扩展
     */
    public $extension;

    /**
     * 请求的id
     */
    public $request_id;

    /**
     * 加密盒子状态，1表示盒子掉线，2表示盒子上线，3表示企业之前有盒子，现在变成了无盒子的状态
     */
    public $status;
}
