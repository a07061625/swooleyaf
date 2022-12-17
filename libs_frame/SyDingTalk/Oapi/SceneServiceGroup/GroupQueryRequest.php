<?php

namespace SyDingTalk\Oapi\SceneServiceGroup;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sceneservicegroup.group.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.21
 */
class GroupQueryRequest extends BaseRequest
{
    /**
     * 表示分页游标，从0开始
     */
    private $cursor;
    /**
     * 群名称
     */
    private $groupName;
    /**
     * 开放群ID
     */
    private $openConversationid;
    /**
     * 群组id
     */
    private $openGroupsetid;
    /**
     * 团队id
     */
    private $openTeamid;
    /**
     * 表示分页大小，size最大不超过100
     */
    private $size;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setGroupName($groupName)
    {
        $this->groupName = $groupName;
        $this->apiParas['group_name'] = $groupName;
    }

    public function getGroupName()
    {
        return $this->groupName;
    }

    public function setOpenConversationid($openConversationid)
    {
        $this->openConversationid = $openConversationid;
        $this->apiParas['open_conversationid'] = $openConversationid;
    }

    public function getOpenConversationid()
    {
        return $this->openConversationid;
    }

    public function setOpenGroupsetid($openGroupsetid)
    {
        $this->openGroupsetid = $openGroupsetid;
        $this->apiParas['open_groupsetid'] = $openGroupsetid;
    }

    public function getOpenGroupsetid()
    {
        return $this->openGroupsetid;
    }

    public function setOpenTeamid($openTeamid)
    {
        $this->openTeamid = $openTeamid;
        $this->apiParas['open_teamid'] = $openTeamid;
    }

    public function getOpenTeamid()
    {
        return $this->openTeamid;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sceneservicegroup.group.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
