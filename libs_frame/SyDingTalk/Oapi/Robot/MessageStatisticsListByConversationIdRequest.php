<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.statistics.listbyconversationid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class MessageStatisticsListByConversationIdRequest extends BaseRequest
{
    /**
     * 群Id列表
     */
    private $conversationIds;
    /**
     * 当前页码
     */
    private $page;
    /**
     * 分页大小
     */
    private $pageSize;
    /**
     * 机器人消息推送Id
     */
    private $pushId;
    /**
     * 已读状态
     */
    private $readStatus;

    public function setConversationIds($conversationIds)
    {
        $this->conversationIds = $conversationIds;
        $this->apiParas['conversation_ids'] = $conversationIds;
    }

    public function getConversationIds()
    {
        return $this->conversationIds;
    }

    public function setPage($page)
    {
        $this->page = $page;
        $this->apiParas['page'] = $page;
    }

    public function getPage()
    {
        return $this->page;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPushId($pushId)
    {
        $this->pushId = $pushId;
        $this->apiParas['push_id'] = $pushId;
    }

    public function getPushId()
    {
        return $this->pushId;
    }

    public function setReadStatus($readStatus)
    {
        $this->readStatus = $readStatus;
        $this->apiParas['read_status'] = $readStatus;
    }

    public function getReadStatus()
    {
        return $this->readStatus;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.statistics.listbyconversationid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->conversationIds, 'conversationIds');
        RequestCheckUtil::checkMaxListSize($this->conversationIds, 20, 'conversationIds');
        RequestCheckUtil::checkNotNull($this->page, 'page');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->pushId, 'pushId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
