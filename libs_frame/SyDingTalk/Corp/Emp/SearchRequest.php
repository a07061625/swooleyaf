<?php

namespace SyDingTalk\Corp\Emp;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.emp.search request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class SearchRequest extends BaseRequest
{
    /**
     * 搜索关键字
     */
    private $keyword;
    /**
     * 偏移量
     */
    private $offset;
    /**
     * 请求数量
     */
    private $size;

    public function setKeyword($keyword)
    {
        $this->keyword = $keyword;
        $this->apiParas['keyword'] = $keyword;
    }

    public function getKeyword()
    {
        return $this->keyword;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
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
        return 'dingtalk.corp.emp.search';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
