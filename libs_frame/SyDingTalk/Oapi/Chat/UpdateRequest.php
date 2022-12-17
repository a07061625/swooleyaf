<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.03.11
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 添加外部联系人成员列表
     */
    private $addExtidlist;
    /**
     * 添加成员列表
     */
    private $addUseridlist;
    /**
     * 群禁言，0-默认，不禁言，1-全员禁言
     */
    private $chatBannedType;
    /**
     * 群会话id
     */
    private $chatid;
    /**
     * 删除外部联系人成员列表
     */
    private $delExtidlist;
    /**
     * 删除成员列表
     */
    private $delUseridlist;
    /**
     * 群头像mediaId
     */
    private $icon;
    /**
     * 是否禁言
     */
    private $isBan;
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
     * 新成员可查看聊天历史 0否 1是
     */
    private $showHistoryType;
    /**
     * 入群验证，0：不入群验证（默认） 1：入群验证
     */
    private $validationType;

    public function setAddExtidlist($addExtidlist)
    {
        $this->addExtidlist = $addExtidlist;
        $this->apiParas['add_extidlist'] = $addExtidlist;
    }

    public function getAddExtidlist()
    {
        return $this->addExtidlist;
    }

    public function setAddUseridlist($addUseridlist)
    {
        $this->addUseridlist = $addUseridlist;
        $this->apiParas['add_useridlist'] = $addUseridlist;
    }

    public function getAddUseridlist()
    {
        return $this->addUseridlist;
    }

    public function setChatBannedType($chatBannedType)
    {
        $this->chatBannedType = $chatBannedType;
        $this->apiParas['chatBannedType'] = $chatBannedType;
    }

    public function getChatBannedType()
    {
        return $this->chatBannedType;
    }

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setDelExtidlist($delExtidlist)
    {
        $this->delExtidlist = $delExtidlist;
        $this->apiParas['del_extidlist'] = $delExtidlist;
    }

    public function getDelExtidlist()
    {
        return $this->delExtidlist;
    }

    public function setDelUseridlist($delUseridlist)
    {
        $this->delUseridlist = $delUseridlist;
        $this->apiParas['del_useridlist'] = $delUseridlist;
    }

    public function getDelUseridlist()
    {
        return $this->delUseridlist;
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

    public function setIsBan($isBan)
    {
        $this->isBan = $isBan;
        $this->apiParas['isBan'] = $isBan;
    }

    public function getIsBan()
    {
        return $this->isBan;
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
        return 'dingtalk.oapi.chat.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->addExtidlist, 20, 'addExtidlist');
        RequestCheckUtil::checkMaxListSize($this->addUseridlist, 20, 'addUseridlist');
        RequestCheckUtil::checkMaxListSize($this->delExtidlist, 20, 'delExtidlist');
        RequestCheckUtil::checkMaxListSize($this->delUseridlist, 20, 'delUseridlist');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
