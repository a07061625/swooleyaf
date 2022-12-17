<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 返回结果
 *
 * @author auto create
 */
class DecorationGroupQueryResponse
{
    /**
     * 入群链接（需特殊申请才返回）
     */
    public $group_url;

    /**
     * 群头像
     */
    public $icon;

    /**
     * 群配置
     */
    public $management_options;

    /**
     * 群成员数量
     */
    public $member_amount;

    /**
     * 群id
     */
    public $open_conversation_id;

    /**
     * 群主id
     */
    public $owner_staff_id;

    /**
     * 场景化数据，在特定场景群有数据
     */
    public $scene_data;

    /**
     * 群管理id
     */
    public $sub_admin_staff_ids;

    /**
     * 模板id
     */
    public $template_id;

    /**
     * 群标题
     */
    public $title;
}
