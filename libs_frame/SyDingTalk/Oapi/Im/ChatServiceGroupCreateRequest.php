<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.servicegroup.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.22
 */
class ChatServiceGroupCreateRequest extends BaseRequest
{
    /**
     * 建群去重的业务id
     */
    private $groupUniqId;
    /**
     * 是否企业内部服务群
     */
    private $orgInnerGroup;
    /**
     * 群主在钉钉组织内的userid
     */
    private $ownerUserid;
    /**
     * 群标题
     */
    private $title;

    public function setGroupUniqId($groupUniqId)
    {
        $this->groupUniqId = $groupUniqId;
        $this->apiParas['group_uniq_id'] = $groupUniqId;
    }

    public function getGroupUniqId()
    {
        return $this->groupUniqId;
    }

    public function setOrgInnerGroup($orgInnerGroup)
    {
        $this->orgInnerGroup = $orgInnerGroup;
        $this->apiParas['org_inner_group'] = $orgInnerGroup;
    }

    public function getOrgInnerGroup()
    {
        return $this->orgInnerGroup;
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
        return 'dingtalk.oapi.im.chat.servicegroup.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
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
