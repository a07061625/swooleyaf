<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scenegroup.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.07
 */
class ChatSceneGroupCreateRequest extends BaseRequest
{
    /**
     * 禁止群成员私聊 若开启，普通群成员之间不能够加好友、单聊，且部分功能使用受限（管理员与非管理员之间不受影响）0-不开启，1-开启
     */
    private $addFriendForbidden;
    /**
     * 群日历 若开启，群内容非好友/同事的成员可相互发起钉钉日程 0-不开启，1-开启
     */
    private $allMembersCanCreateCalendar;
    /**
     * 群会议 若开启，群内任意成员可发起视频和语音会议 0-不开启，1-开启
     */
    private $allMembersCanCreateMcsConf;
    /**
     * 群禁言，0-默认，不禁言，1-全员禁言
     */
    private $chatBannedType;
    /**
     * 禁止发送群邮件 若开启，群内成员不可再对本群发送群邮件 0-不开启，1-开启
     */
    private $groupEmailDisabled;
    /**
     * 群直播 若开启，群内任意成员可发起群直播 0-不开启，1-开启
     */
    private $groupLiveSwitch;
    /**
     * 群头像mediaId
     */
    private $icon;
    /**
     * 管理类型，0-默认，所有人可管理，1-仅群主可管理
     */
    private $managementType;
    /**
     * 禁止非管理员向管理员发起单聊 若开启，非管理员不能向管理员发起单聊 0-不开启，1-开启
     */
    private $membersToAdminChat;
    /**
     * @all 权限，0-默认，所有人，1-仅群主可@all
     */
    private $mentionAllAuthority;
    /**
     * 仅群主和管理员可在群内发DING  0-不开启，1-开启
     */
    private $onlyAdminCanDing;
    /**
     * 仅群主和管理员可置顶群消息 0-不开启，1-开启
     */
    private $onlyAdminCanSetMsgTop;
    /**
     * 群主userid
     */
    private $ownerUserId;
    /**
     * 群可搜索，0-默认，不可搜索，1-可搜索
     */
    private $searchable;
    /**
     * 新成员是否可查看聊天历史消息，0-默认，否，1-是
     */
    private $showHistoryType;
    /**
     * 群管理员useridlist
     */
    private $subadminIds;
    /**
     * 群模板id
     */
    private $templateId;
    /**
     * 群名称
     */
    private $title;
    /**
     * 群成员useridlist
     */
    private $userIds;
    /**
     * 建群去重的业务id
     */
    private $uuid;
    /**
     * 入群验证，0：不入群验证（默认） 1：入群验证
     */
    private $validationType;

    public function setAddFriendForbidden($addFriendForbidden)
    {
        $this->addFriendForbidden = $addFriendForbidden;
        $this->apiParas['add_friend_forbidden'] = $addFriendForbidden;
    }

    public function getAddFriendForbidden()
    {
        return $this->addFriendForbidden;
    }

    public function setAllMembersCanCreateCalendar($allMembersCanCreateCalendar)
    {
        $this->allMembersCanCreateCalendar = $allMembersCanCreateCalendar;
        $this->apiParas['all_members_can_create_calendar'] = $allMembersCanCreateCalendar;
    }

    public function getAllMembersCanCreateCalendar()
    {
        return $this->allMembersCanCreateCalendar;
    }

    public function setAllMembersCanCreateMcsConf($allMembersCanCreateMcsConf)
    {
        $this->allMembersCanCreateMcsConf = $allMembersCanCreateMcsConf;
        $this->apiParas['all_members_can_create_mcs_conf'] = $allMembersCanCreateMcsConf;
    }

    public function getAllMembersCanCreateMcsConf()
    {
        return $this->allMembersCanCreateMcsConf;
    }

    public function setChatBannedType($chatBannedType)
    {
        $this->chatBannedType = $chatBannedType;
        $this->apiParas['chat_banned_type'] = $chatBannedType;
    }

    public function getChatBannedType()
    {
        return $this->chatBannedType;
    }

    public function setGroupEmailDisabled($groupEmailDisabled)
    {
        $this->groupEmailDisabled = $groupEmailDisabled;
        $this->apiParas['group_email_disabled'] = $groupEmailDisabled;
    }

    public function getGroupEmailDisabled()
    {
        return $this->groupEmailDisabled;
    }

    public function setGroupLiveSwitch($groupLiveSwitch)
    {
        $this->groupLiveSwitch = $groupLiveSwitch;
        $this->apiParas['group_live_switch'] = $groupLiveSwitch;
    }

    public function getGroupLiveSwitch()
    {
        return $this->groupLiveSwitch;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        $this->apiParas['icon'] = $icon;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setManagementType($managementType)
    {
        $this->managementType = $managementType;
        $this->apiParas['management_type'] = $managementType;
    }

    public function getManagementType()
    {
        return $this->managementType;
    }

    public function setMembersToAdminChat($membersToAdminChat)
    {
        $this->membersToAdminChat = $membersToAdminChat;
        $this->apiParas['members_to_admin_chat'] = $membersToAdminChat;
    }

    public function getMembersToAdminChat()
    {
        return $this->membersToAdminChat;
    }

    public function setMentionAllAuthority($mentionAllAuthority)
    {
        $this->mentionAllAuthority = $mentionAllAuthority;
        $this->apiParas['mention_all_authority'] = $mentionAllAuthority;
    }

    public function getMentionAllAuthority()
    {
        return $this->mentionAllAuthority;
    }

    public function setOnlyAdminCanDing($onlyAdminCanDing)
    {
        $this->onlyAdminCanDing = $onlyAdminCanDing;
        $this->apiParas['only_admin_can_ding'] = $onlyAdminCanDing;
    }

    public function getOnlyAdminCanDing()
    {
        return $this->onlyAdminCanDing;
    }

    public function setOnlyAdminCanSetMsgTop($onlyAdminCanSetMsgTop)
    {
        $this->onlyAdminCanSetMsgTop = $onlyAdminCanSetMsgTop;
        $this->apiParas['only_admin_can_set_msg_top'] = $onlyAdminCanSetMsgTop;
    }

    public function getOnlyAdminCanSetMsgTop()
    {
        return $this->onlyAdminCanSetMsgTop;
    }

    public function setOwnerUserId($ownerUserId)
    {
        $this->ownerUserId = $ownerUserId;
        $this->apiParas['owner_user_id'] = $ownerUserId;
    }

    public function getOwnerUserId()
    {
        return $this->ownerUserId;
    }

    public function setSearchable($searchable)
    {
        $this->searchable = $searchable;
        $this->apiParas['searchable'] = $searchable;
    }

    public function getSearchable()
    {
        return $this->searchable;
    }

    public function setShowHistoryType($showHistoryType)
    {
        $this->showHistoryType = $showHistoryType;
        $this->apiParas['show_history_type'] = $showHistoryType;
    }

    public function getShowHistoryType()
    {
        return $this->showHistoryType;
    }

    public function setSubadminIds($subadminIds)
    {
        $this->subadminIds = $subadminIds;
        $this->apiParas['subadmin_ids'] = $subadminIds;
    }

    public function getSubadminIds()
    {
        return $this->subadminIds;
    }

    public function setTemplateId($templateId)
    {
        $this->templateId = $templateId;
        $this->apiParas['template_id'] = $templateId;
    }

    public function getTemplateId()
    {
        return $this->templateId;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        $this->apiParas['title'] = $title;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['user_ids'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        $this->apiParas['uuid'] = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function setValidationType($validationType)
    {
        $this->validationType = $validationType;
        $this->apiParas['validation_type'] = $validationType;
    }

    public function getValidationType()
    {
        return $this->validationType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scenegroup.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->ownerUserId, 'ownerUserId');
        RequestCheckUtil::checkMaxListSize($this->subadminIds, 999, 'subadminIds');
        RequestCheckUtil::checkNotNull($this->templateId, 'templateId');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkMaxListSize($this->userIds, 999, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
