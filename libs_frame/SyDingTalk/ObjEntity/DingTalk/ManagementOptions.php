<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * 群配置
 *
 * @author auto create
 */
class ManagementOptions
{
    /**
     * 群禁言，0-默认，不禁言，1-全员禁言
     */
    public $chat_banned_type;

    /**
     * 管理类型，0-默认，所有人可管理，1-仅群主可管理
     */
    public $management_type;

    /**
     * @all 权限，0-默认，所有人，1-仅群主可@all
     */
    public $mention_all_authority;

    /**
     * 群可搜索，0-默认，不可搜索，1-可搜索
     */
    public $searchable;

    /**
     * 新成员是否可查看聊天历史消息，0-默认，否，1-是
     */
    public $show_history_type;

    /**
     * 入群验证，0：不入群验证（默认） 1：入群验证
     */
    public $validation_type;
}
