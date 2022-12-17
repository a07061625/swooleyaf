<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.getsimplegroups request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.15
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
        return 'dingtalk.oapi.attendance.getsimplegroups';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
