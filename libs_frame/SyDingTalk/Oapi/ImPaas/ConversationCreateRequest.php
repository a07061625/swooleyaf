<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.impaas.conversation.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.02
 */
class ConversationCreateRequest extends BaseRequest
{
    /**
     * 渠道
     */
    private $channel;
    /**
     * 群名称
     */
    private $name;
    /**
     * 群主员工id
     */
    private $ownerUserid;
    /**
     * 成员员工id列表
     */
    private $useridList;

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
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

    public function setOwnerUserid($ownerUserid)
    {
        $this->ownerUserid = $ownerUserid;
        $this->apiParas['owner_userid'] = $ownerUserid;
    }

    public function getOwnerUserid()
    {
        return $this->ownerUserid;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.impaas.conversation.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->channel, 'channel');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkNotNull($this->ownerUserid, 'ownerUserid');
        RequestCheckUtil::checkNotNull($this->useridList, 'useridList');
        RequestCheckUtil::checkMaxListSize($this->useridList, 500, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
