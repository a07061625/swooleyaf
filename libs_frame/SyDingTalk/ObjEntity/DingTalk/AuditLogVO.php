<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 记录列表
 *
 * @author auto create
 */
class AuditLogVO
{
    /**
     * 操作类型
     */
    public $action;

    /**
     * 操作类型翻译值
     */
    public $action_view;

    /**
     * 文件id
     */
    public $biz_id;

    /**
     * 文档授权成员列表，仅授权文档操作有效
     */
    public $doc_member_info_list;

    /**
     * 文档分享成员列表，仅分享文档时有效
     */
    public $doc_receiver_list;

    /**
     * 记录生成时间，unix时间戳，单位ms
     */
    public $gmt_create;

    /**
     * 记录修改时间，unix时间戳，单位ms
     */
    public $gmt_modified;

    /**
     * 操作机器ip
     */
    public $ip_address;

    /**
     * 操作来源空间
     */
    public $operate_module;

    /**
     * 操作来源翻译值
     */
    public $operate_module_view;

    /**
     * 用户昵称
     */
    public $operator_name;

    /**
     * 文件所属组织名称
     */
    public $org_name;

    /**
     * 操作端
     */
    public $platform;

    /**
     * 操作端翻译值
     */
    public $platform_view;

    /**
     * 用户姓名
     */
    public $real_name;

    /**
     * 文件接收方名称
     */
    public $receiver_name;

    /**
     * 文件接收方类型
     */
    public $receiver_type;

    /**
     * 接收方类型翻译值
     */
    public $receiver_type_view;

    /**
     * 文件名
     */
    public $resource;

    /**
     * 文件类型
     */
    public $resource_extension;

    /**
     * 文件大小
     */
    public $resource_size;

    /**
     * 记录状态
     */
    public $status;

    /**
     * 空间id
     */
    public $target_space_id;

    /**
     * 员工的userId
     */
    public $userid;
}
