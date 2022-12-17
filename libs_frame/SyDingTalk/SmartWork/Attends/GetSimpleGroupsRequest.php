<?php

namespace SyDingTalk\SmartWork\Attends;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.smartwork.attends.getsimplegroups request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetSimpleGroupsRequest extends BaseRequest
{
    /**
     * 偏移位置
     */
    private $offset;
    /**
     * 分页大小，最大10
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
        return 'dingtalk.smartwork.attends.getsimplegroups';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
