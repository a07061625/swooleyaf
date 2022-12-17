<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 接口返回
 *
 * @author auto create
 */
class Result
{
    /**
     * 错误码
     */
    public $errcode;

    /**
     * 错误信息
     */
    public $errmsg;

    /**
     * 接口返回model
     */
    public $module;

    /**
     * 是否成功
     */
    public $success;
}
