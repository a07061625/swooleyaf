<?php

namespace SyDingTalk\Oapi\Call;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.call.getuserlist request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetUserListRequest extends BaseRequest
{
    /**
     * 偏移量
     */
    private $offset;
    /**
     * size
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
        return 'dingtalk.oapi.call.getuserlist';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
