<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * appList
 *
 * @author auto create
 */
class Applist
{
    /**
     * 微应用实例化id
     */
    public $agent_id;

    /**
     * 微应用描述
     */
    public $app_desc;

    /**
     * 微应用图标
     */
    public $app_icon;

    /**
     * 三方应用id
     */
    public $app_id;

    /**
     * 微应用状态，1表示启用，0表示停用
     */
    public $app_status;

    /**
     * 微应用的移动端主页
     */
    public $homepage_link;

    /**
     * 表示是否是自建微应用
     */
    public $is_self;

    /**
     * 微应用名称
     */
    public $name;

    /**
     * 微应用的OA后台管理主页
     */
    public $omp_link;

    /**
     * 微应用的pc端主页
     */
    public $pc_homepage_link;
}
