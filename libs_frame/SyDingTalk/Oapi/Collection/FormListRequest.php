<?php

namespace SyDingTalk\Oapi\Collection;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.collection.form.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.16
 */
class FormListRequest extends BaseRequest
{
    /**
     * 填表类型。0表示通用填表，1表示教育版填表
     */
    private $bizType;
    /**
     * 填表创建人userid
     */
    private $creator;
    /**
     * 分页游标，从0开始。后续取返回结果中next_cursor的值
     */
    private $offset;
    /**
     * 分页大小，最大200
     */
    private $size;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setCreator($creator)
    {
        $this->creator = $creator;
        $this->apiParas['creator'] = $creator;
    }

    public function getCreator()
    {
        return $this->creator;
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
        return 'dingtalk.oapi.collection.form.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
