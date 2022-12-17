<?php

namespace SyDingTalk\Oapi\Hire;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hire.statistics.bizflow.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.21
 */
class StatisticsBizFlowListRequest extends BaseRequest
{
    /**
     * 分页游标位置，不传默认第一页
     */
    private $cursor;
    /**
     * 分页大小，最大200
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
        return 'dingtalk.oapi.hire.statistics.bizflow.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 200, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
