<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 接口返回model
 *
 * @author auto create
 */
class OnlineNavigationModel
{
    /**
     * 子菜单列表
     */
    public $children;

    /**
     * 表单id 如果非表单类菜单，可为空
     */
    public $form_uuid;

    /**
     * 图标地址
     */
    public $icon;

    /**
     * 是否新打开页面 0:不打开 1：新打开
     */
    public $is_new;

    /**
     * 链接地址
     */
    public $link_url;

    /**
     * 菜单排序序号
     */
    public $list_order;

    /**
     * 1:隐藏 0：不隐藏
     */
    public $mobile_hidden;

    /**
     * 菜单名称
     */
    public $name;

    /**
     * 导航类型：sw_form：表单类到导航 group：分组类  outLinker：链接跳转
     */
    public $nav_type;

    /**
     * 树形结构 父菜单id
     */
    public $parent_id;

    /**
     * 1:隐藏 0：不隐藏
     */
    public $pc_hidden;
}
