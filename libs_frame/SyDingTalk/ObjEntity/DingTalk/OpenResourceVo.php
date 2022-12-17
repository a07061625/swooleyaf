<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 资源授权结果列表
 *
 * @author auto create
 */
class OpenResourceVo
{
    /**
     * 资源id（加密后的值）
     */
    public $resource_id;

    /**
     * 资源类型
     */
    public $resource_type;

    /**
     * 是否授权成功（0:成功，1:失败）
     */
    public $status;
}
