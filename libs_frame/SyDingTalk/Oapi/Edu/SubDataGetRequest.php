<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.sub.data.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.29
 */
class SubDataGetRequest extends BaseRequest
{
    /**
     * 排序因子
     */
    private $orders;
    /**
     * 页码，必须大于0
     */
    private $pageNum;
    /**
     * 每页大小，必须大于0
     */
    private $pageSize;
    /**
     * 统计日期
     */
    private $statDate;

    public function setOrders($orders)
    {
        $this->orders = $orders;
        $this->apiParas['orders'] = $orders;
    }

    public function getOrders()
    {
        return $this->orders;
    }

    public function setPageNum($pageNum)
    {
        $this->pageNum = $pageNum;
        $this->apiParas['page_num'] = $pageNum;
    }

    public function getPageNum()
    {
        return $this->pageNum;
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

    public function setStatDate($statDate)
    {
        $this->statDate = $statDate;
        $this->apiParas['stat_date'] = $statDate;
    }

    public function getStatDate()
    {
        return $this->statDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.sub.data.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->pageNum, 'pageNum');
        RequestCheckUtil::checkNotNull($this->pageSize, 'pageSize');
        RequestCheckUtil::checkNotNull($this->statDate, 'statDate');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
