<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.job.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.26
 */
class JobQueryRequest extends BaseRequest
{
    /**
     * 招聘业务标识
     */
    private $bizCode;
    /**
     * 分页游标，传空时默认为第一页
     */
    private $cursor;
    /**
     * 查询参数
     */
    private $queryParam;
    /**
     * 分页大小，最大200
     */
    private $size;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setQueryParam($queryParam)
    {
        $this->queryParam = $queryParam;
        $this->apiParas['query_param'] = $queryParam;
    }

    public function getQueryParam()
    {
        return $this->queryParam;
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
        return 'dingtalk.oapi.ats.job.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 200, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
