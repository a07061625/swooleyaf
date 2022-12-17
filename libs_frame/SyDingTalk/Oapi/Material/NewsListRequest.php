<?php

namespace SyDingTalk\Oapi\Material;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.material.news.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.04
 */
class NewsListRequest extends BaseRequest
{
    /**
     * 每页条数
     */
    private $pageSize;
    /**
     * 页码，第几页，从1开始算
     */
    private $pageStart;
    /**
     * 服务号的unionid
     */
    private $unionid;

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
    }

    public function setPageStart($pageStart)
    {
        $this->pageStart = $pageStart;
        $this->apiParas['page_start'] = $pageStart;
    }

    public function getPageStart()
    {
        return $this->pageStart;
    }

    public function setUnionid($unionid)
    {
        $this->unionid = $unionid;
        $this->apiParas['unionid'] = $unionid;
    }

    public function getUnionid()
    {
        return $this->unionid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.material.news.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxValue($this->pageSize, 20, 'pageSize');
        RequestCheckUtil::checkMinValue($this->pageSize, 1, 'pageSize');
        RequestCheckUtil::checkNotNull($this->unionid, 'unionid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
