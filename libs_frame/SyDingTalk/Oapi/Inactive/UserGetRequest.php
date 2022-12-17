<?php

namespace SyDingTalk\Oapi\Inactive;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.inactive.user.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.22
 */
class UserGetRequest extends BaseRequest
{
    /**
     * 获取数据偏移量，从0开始
     */
    private $offset;
    /**
     * 查询日期
     */
    private $queryDate;
    /**
     * 获取数据size,最大100
     */
    private $size;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setQueryDate($queryDate)
    {
        $this->queryDate = $queryDate;
        $this->apiParas['query_date'] = $queryDate;
    }

    public function getQueryDate()
    {
        return $this->queryDate;
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
        return 'dingtalk.oapi.inactive.user.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->queryDate, 'queryDate');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
