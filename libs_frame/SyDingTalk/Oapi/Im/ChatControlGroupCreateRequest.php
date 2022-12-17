<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.controlgroup.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.29
 */
class ChatControlGroupCreateRequest extends BaseRequest
{
    /**
     * 群的管理权限设置，0-所有人可管理（默认），1-仅群主和群管理员可管理
     */
    private $authorityType;
    /**
     * goc模拟群：goc， 网商银行群：eCommerce
     */
    private $groupType;
    /**
     * 建群去重的业务id
     */
    private $groupUniqId;
    /**
     * 群成员在钉钉组织内的userid列表
     */
    private $memberUserids;
    /**
     * 群主在钉钉组织内的userid
     */
    private $ownerUserid;
    /**
     * 群标题
     */
    private $title;

    public function setAuthorityType($authorityType)
    {
        $this->authorityType = $authorityType;
        $this->apiParas['authority_type'] = $authorityType;
    }

    public function getAuthorityType()
    {
        return $this->authorityType;
    }

    public function setGroupType($groupType)
    {
        $this->groupType = $groupType;
        $this->apiParas['group_type'] = $groupType;
    }

    public function getGroupType()
    {
        return $this->groupType;
    }

    public function setGroupUniqId($groupUniqId)
    {
        $this->groupUniqId = $groupUniqId;
        $this->apiParas['group_uniq_id'] = $groupUniqId;
    }

    public function getGroupUniqId()
    {
        return $this->groupUniqId;
    }

    public function setMemberUserids($memberUserids)
    {
        $this->memberUserids = $memberUserids;
        $this->apiParas['member_userids'] = $memberUserids;
    }

    public function getMemberUserids()
    {
        return $this->memberUserids;
    }

    public function setOwnerUserid($ownerUserid)
    {
        $this->ownerUserid = $ownerUserid;
        $this->apiParas['owner_userid'] = $ownerUserid;
    }

    public function getOwnerUserid()
    {
        return $this->ownerUserid;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.controlgroup.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->memberUserids, 'memberUserids');
        RequestCheckUtil::checkMaxListSize($this->memberUserids, 20, 'memberUserids');
        RequestCheckUtil::checkNotNull($this->ownerUserid, 'ownerUserid');
        RequestCheckUtil::checkNotNull($this->title, 'title');
        RequestCheckUtil::checkMaxLength($this->title, 256, 'title');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
