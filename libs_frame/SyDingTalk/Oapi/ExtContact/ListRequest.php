<?php

namespace SyDingTalk\Oapi\ExtContact;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.extcontact.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.09
 */
class ListRequest extends BaseRequest
{
    /**
     * 支持分页查询，与size参数同时设置时才生效，此参数代表偏移量，偏移量从0开始。
     */
    private $offset;
    /**
     * 支持分页查询，与offset参数同时设置时才生效，此参数代表分页大小，最大100。
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
        return 'dingtalk.oapi.extcontact.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMinValue($this->offset, 0, 'offset');
        RequestCheckUtil::checkMaxValue($this->size, 100, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
