<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * list
 *
 * @author auto create
 */
class Templatelist
{
    /**
     * 是否可升级，加入收款账户组件
     */
    public $can_be_upgraded;

    /**
     * 是否有管理权限
     */
    public $can_modify;

    /**
     * 模板内容
     */
    public $form_content;

    /**
     * 模板图标url
     */
    public $icon_url;

    /**
     * 模板名称
     */
    public $name;

    /**
     * 模板code
     */
    public $process_code;

    /**
     * 模板跳转地址
     */
    public $url;
}
