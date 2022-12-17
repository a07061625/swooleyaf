<?php

namespace SyDingTalk\Oapi\Role;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.role.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ListRequest extends BaseRequest
{
    /**
     * 分页偏移
     */
    private $offset;
    /**
     * 分页大小
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
        return 'dingtalk.oapi.role.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
