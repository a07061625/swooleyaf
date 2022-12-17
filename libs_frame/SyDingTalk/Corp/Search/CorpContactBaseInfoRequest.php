<?php

namespace SyDingTalk\Corp\Search;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.search.corpcontact.baseinfo request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class CorpContactBaseInfoRequest extends BaseRequest
{
    /**
     * 开始位置,从0开始
     */
    private $offset;
    /**
     * 搜索词,长度大于2开始搜
     */
    private $query;
    /**
     * 拉取个数上限100
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

    public function setQuery($query)
    {
        $this->query = $query;
        $this->apiParas['query'] = $query;
    }

    public function getQuery()
    {
        return $this->query;
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
        return 'dingtalk.corp.search.corpcontact.baseinfo';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->query, 'query');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
