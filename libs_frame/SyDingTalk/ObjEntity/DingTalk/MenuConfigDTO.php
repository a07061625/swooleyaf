<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 菜单
 *
 * @author auto create
 */
class MenuConfigDTO
{
    /**
     * 菜单按钮列表
     */
    public $button;

    /**
     * 是否允许用户输入
     */
    public $enable_input;

    /**
     * 状态，0-正常，1-停用
     */
    public $status;
}
