<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 邀请信息
 *
 * @author auto create
 */
class InviteUrlQuery
{
    /**
     * 圈子里关联的某个群ID
     */
    public $chat_id;

    /**
     * 该分享链接有效时间，以秒为单位。 最大不超过7776000（即90天），此字段如果不填，则默认有效期为30秒。
     */
    public $expire_seconds;

    /**
     * 活动生效后的承接页面标志
     */
    public $redirect;

    /**
     * 场景标志，用于区分活动场景
     */
    public $scene_id;

    /**
     * 期限类型：SHORT短期（默认），LONG长期（最多10万个数量限制）
     */
    public $term_type;

    /**
     * 邀请人的员工ID
     */
    public $userid;
}
