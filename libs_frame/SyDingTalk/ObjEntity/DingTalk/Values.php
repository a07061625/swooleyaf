<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 数据列表
 *
 * @author auto create
 */
class Values
{
    /**
     * 创建记录的用户昵称
     */
    public $creator_nick;

    /**
     * 创建记录的用户ID
     */
    public $creator_userid;

    /**
     * 数据内容
     */
    public $data;

    /**
     * 扩展数据内容
     */
    public $extend_data;

    /**
     * 记录创建时间
     */
    public $gmt_create;

    /**
     * 记录修改时间
     */
    public $gmt_modified;

    /**
     * 数据ID
     */
    public $instance_id;

    /**
     * 数据类型
     */
    public $object_type;

    /**
     * 数据权限信息
     */
    public $permission;

    /**
     * 审批状态
     */
    public $proc_inst_status;

    /**
     * 审批结果
     */
    public $proc_out_result;
}
