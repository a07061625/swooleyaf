<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 创建群请求对象
 *
 * @author auto create
 */
class CreateGroupRequest
{
    /**
     * 接入方channel信息，该值由接入方接入IMPaaS平台时，向IMPaaS平台申请，例如“hema”“eleme”等。
     */
    public $channel;

    /**
     * 创建者
     */
    public $creater;

    /**
     * 二级会话入口ID
     */
    public $entrance_id;

    /**
     * 扩展数据,业务可以自定义，目前最大支持256B
     */
    public $extension;

    /**
     * 群成员列表
     */
    public $member_list;

    /**
     * 群名称
     */
    public $name;

    /**
     * 新人进群是否能查看最近100条记录。0:不能；1:可以查看最近100条记录；不填默认为0
     */
    public $show_history_type;

    /**
     * 群类型,目前没有使用，填0即可
     */
    public $type;

    /**
     * uuid, 用于防止弱网情况下超时导致重复创建, 一分钟内传递相同的uuid会返回同一个群，传空则不去重
     */
    public $uuid;
}
