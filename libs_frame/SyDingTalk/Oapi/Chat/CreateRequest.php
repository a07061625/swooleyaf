<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.03.11
 */
class CreateRequest extends BaseRequest
{
    /**
     * 群禁言，0-默认，不禁言，1-全员禁言
     */
    private $chatBannedType;
    /**
     * 群类型，2：企业群，0：普通群
     */
    private $conversationTag;
    /**
     * 外部联系人成员列表
     */
    private $extidlist;
    /**
     * 群头像资源id
     */
    private $icon;
    /**
     * 管理类型，0-默认，所有人可管理，1-仅群主可管理
     */
    private $managementType;
    /**
     * @all 权限，0-默认，所有人，1-仅群主可@all
     */
    private $mentionAllAuthority;
    /**
     * 群名称
     */
    private $name;
    /**
     * 群主的userId
     */
    private $owner;
    /**
     * 群主类型，emp：企业员工，ext：外部联系人
     */
    private $ownerType;
    /**
     * 群可搜索，0-默认，不可搜索，1-可搜索
     */
    private $searchable;
    /**
     * 新成员可查看100条聊天历史消息的类型，1：可查看，默认或0：不可查看
     */
    private $showHistoryType;
    /**
     * 群成员userId列表
     */
    private $useridlist;
    /**
     * 入群验证，0：不入群验证（默认） 1：入群验证
     */
    private $validationType;

    public function setChatBannedType($chatBannedType)
    {
        $this->chatBannedType = $chatBannedType;
        $this->apiParas['chatBannedType'] = $chatBannedType;
    }

    public function getChatBannedType()
    {
        return $this->chatBannedType;
    }

    public function setConversationTag($conversationTag)
    {
        $this->conversationTag = $conversationTag;
        $this->apiParas['conversationTag'] = $conversationTag;
    }

    public function getConversationTag()
    {
        return $this->conversationTag;
    }

    public function setExtidlist($extidlist)
    {
        $this->extidlist = $extidlist;
        $this->apiParas['extidlist'] = $extidlist;
    }

    public function getExtidlist()
    {
        return $this->extidlist;
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
        $this->apiParas['managementType'] = $managementType;
    }

    public function getManagementType()
    {
        return $this->managementType;
    }

    public function setMentionAllAuthority($mentionAllAuthority)
    {
        $this->mentionAllAuthority = $mentionAllAuthority;
        $this->apiParas['mentionAllAuthority'] = $mentionAllAuthority;
    }

    public function getMentionAllAuthority()
    {
        return $this->mentionAllAuthority;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOwner($owner)
    {
        $this->owner = $owner;
        $this->apiParas['owner'] = $owner;
    }

    public function getOwner()
    {
        return $this->owner;
    }

    public function setOwnerType($ownerType)
    {
        $this->ownerType = $ownerType;
        $this->apiParas['ownerType'] = $ownerType;
    }

    public function getOwnerType()
    {
        return $this->ownerType;
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
        $this->apiParas['showHistoryType'] = $showHistoryType;
    }

    public function getShowHistoryType()
    {
        return $this->showHistoryType;
    }

    public function setUseridlist($useridlist)
    {
        $this->useridlist = $useridlist;
        $this->apiParas['useridlist'] = $useridlist;
    }

    public function getUseridlist()
    {
        return $this->useridlist;
    }

    public function setValidationType($validationType)
    {
        $this->validationType = $validationType;
        $this->apiParas['validationType'] = $validationType;
    }

    public function getValidationType()
    {
        return $this->validationType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->extidlist, 20, 'extidlist');
        RequestCheckUtil::checkMaxListSize($this->useridlist, 20, 'useridlist');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
