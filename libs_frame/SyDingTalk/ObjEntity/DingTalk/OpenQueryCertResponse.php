<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果值
 *
 * @author auto create
 */
class OpenQueryCertResponse
{
    /**
     * 认证明细
     */
    public $cert_datas;

    /**
     * 当前用户最高认证等级。0:没有认证；1:初级；2:中级；3:高级；
     */
    public $current_cert_level;

    /**
     * 实操任务完成信息
     */
    public $practical_task_data;
}
