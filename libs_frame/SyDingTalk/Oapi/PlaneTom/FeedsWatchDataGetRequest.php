<?php

namespace SyDingTalk\Oapi\PlaneTom;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.planetom.feeds.watchdata.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.27
 */
class FeedsWatchDataGetRequest extends BaseRequest
{
    /**
     * 主播在组织内的id（staffId）
     */
    private $anchorId;
    /**
     * 群的openconversationId(群对外的id)
     */
    private $chatId;
    /**
     * 课程id
     */
    private $feedId;
    /**
     * 分页起始位置（不传默认获取前10个）
     */
    private $index;
    /**
     * 分页大小(默认0开始)
     */
    private $pageSize;

    public function setAnchorId($anchorId)
    {
        $this->anchorId = $anchorId;
        $this->apiParas['anchor_id'] = $anchorId;
    }

    public function getAnchorId()
    {
        return $this->anchorId;
    }

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setFeedId($feedId)
    {
        $this->feedId = $feedId;
        $this->apiParas['feed_id'] = $feedId;
    }

    public function getFeedId()
    {
        return $this->feedId;
    }

    public function setIndex($index)
    {
        $this->index = $index;
        $this->apiParas['index'] = $index;
    }

    public function getIndex()
    {
        return $this->index;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.planetom.feeds.watchdata.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->anchorId, 'anchorId');
        RequestCheckUtil::checkNotNull($this->feedId, 'feedId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
