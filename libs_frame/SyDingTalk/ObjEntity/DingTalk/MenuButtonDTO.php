<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 菜单按钮列表
 *
 * @author auto create
 */
class MenuButtonDTO
{
    /**
     * 菜单绑定的key值
     */
    public $key;

    /**
     * 素材id
     */
    public $media_id;

    /**
     * 名称
     */
    public $name;

    /**
     * 子菜单按钮列表
     */
    public $sub_button;

    /**
     * 类型
     */
    public $type;

    /**
     * 菜单绑定的URL
     */
    public $url;
}
