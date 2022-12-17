<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 企业下指定应用已添加快捷方式列表
 *
 * @author auto create
 */
class IsvOrgShortcutDTO
{
    /**
     * 业务单号,系统间交互唯一流水号
     */
    public $biz_no;

    /**
     * 快捷方式图标
     */
    public $icon;

    /**
     * 快捷方式名称
     */
    public $name;

    /**
     * PC端快捷方式地址
     */
    public $pc_shortcut_uri;

    /**
     * 移动端快捷方式地址(默认地址)
     */
    public $shortcut_uri;
}
