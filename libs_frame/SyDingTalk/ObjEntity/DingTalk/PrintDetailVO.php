<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 打印详情列表
 *
 * @author auto create
 */
class PrintDetailVO
{
    /**
     * 部门扩展信息
     */
    public $dept_ext_info;

    /**
     * 部门全称
     */
    public $dept_full_name;

    /**
     * 一级部门名
     */
    public $dept_level1_name;

    /**
     * 二级部门名
     */
    public $dept_level2_name;

    /**
     * 三级部门名
     */
    public $dept_level3_name;

    /**
     * 打印来源编号，0-5： 0-其他  1-pc驱动  2-二维码   3-审批   4-钉盘  5-IM
     */
    public $origin;

    /**
     * 彩色或黑白打印类型.0黑白，1彩色
     */
    public $page_color_type;

    /**
     * 单双面类型，0是单面，1是双面
     */
    public $page_double_type;

    /**
     * 纸张大小类型 A3
     */
    public $page_size_type;

    /**
     * 打印总页数
     */
    public $pages;

    /**
     * 打印时间戳，单位是毫秒
     */
    public $print_date;

    /**
     * 打印机名称
     */
    public $printer_nick;

    /**
     * 用户名
     */
    public $user_name;
}
