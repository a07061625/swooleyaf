<?php

namespace SyDingTalk\Oapi\WorkRecord;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workrecord.getbyuserid request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.12
 */
class GetByUserIdRequest extends BaseRequest
{
    /**
     * 分页大小，最多50
     */
    private $limit;
    /**
     * 分页游标，从0开始，如返回结果中has_more为true，则表示还有数据，offset再传上一次的offset+limit
     */
    private $offset;
    /**
     * 待办事项状态，0表示未完成，1表示完成
     */
    private $status;
    /**
     * 用户唯一ID
     */
    private $userid;

    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->apiParas['limit'] = $limit;
    }

    public function getLimit()
    {
        return $this->limit;
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

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.workrecord.getbyuserid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->limit, 'limit');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
