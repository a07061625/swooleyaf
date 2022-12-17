<?php

namespace SyDingTalk\Isv\Call;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.isv.call.getuserlist request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetUserListRequest extends BaseRequest
{
    /**
     * 批量值
     */
    private $offset;
    /**
     * 游标开始值
     */
    private $start;

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setStart($start)
    {
        $this->start = $start;
        $this->apiParas['start'] = $start;
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.isv.call.getuserlist';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
