<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.statistics.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class MessageStatisticsListRequest extends BaseRequest
{
    /**
     * 当前页码
     */
    private $page;
    /**
     * 分页大小
     */
    private $pageSize;
    /**
     * 机器人消息推送Id列表
     */
    private $pushIds;

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

    public function setPushIds($pushIds)
    {
        $this->pushIds = $pushIds;
        $this->apiParas['push_ids'] = $pushIds;
    }

    public function getPushIds()
    {
        return $this->pushIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.statistics.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->page, 'page');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->pushIds, 'pushIds');
        RequestCheckUtil::checkMaxListSize($this->pushIds, 20, 'pushIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
