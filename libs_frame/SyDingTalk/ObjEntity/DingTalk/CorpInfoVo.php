<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 企业列表
 *
 * @author auto create
 */
class CorpInfoVo
{
    /**
     * 是否认证，0表示未认证，1表示认证
     */
    public $auth_status;

    /**
     * 企业名称
     */
    public $corp_name;

    /**
     * 企业id
     */
    public $corpid;
}
