<?php

namespace SyDingTalk\Corp\ExtContact;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.extcontact.listlabelgroups request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ListLabelGroupsRequest extends BaseRequest
{
    /**
     * 偏移位置
     */
    private $offset;
    /**
     * 分页大小,最大100
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
        return 'dingtalk.corp.extcontact.listlabelgroups';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxValue($this->size, 100, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
