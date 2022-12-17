<?php

namespace SyDingTalk\ObjEntity\DingTalk;

/**
 * chat_info
 *
 * @author auto create
 */
class ChatInfo
{
    /**
     * agentidlist
     */
    public $agentidlist;

    /**
     * 是否全员禁用 0 不禁言 1 全员禁言
     */
    public $chat_banned_type;

    /**
     * conversationTag
     */
    public $conversation_tag;

    /**
     * extidlist
     */
    public $extidlist;

    /**
     * 群头像mediaId
     */
    public $icon;

    /**
     * 仅群主和群管理员可管理 0否 1 是
     */
    public $management_type;

    /**
     * 尽群主和管理员可@所有人 0 否 1 是
     */
    public $mention_all_authority;

    /**
     * name
     */
    public $name;

    /**
     * owner
     */
    public $owner;

    /**
     * 是否可以搜索群名 0 不可以 1可以搜索
     */
    public $searchable;

    /**
     * 新成员可查看聊天历史 0否 1是
     */
    public $show_history_type;

    /**
     * 群状态 1-正常 2-已解散
     */
    public $status;

    /**
     * useridlist
     */
    public $useridlist;

    /**
     * 入群需群主或群管理员同意 0不需要 1需要
     */
    public $validation_type;
}
