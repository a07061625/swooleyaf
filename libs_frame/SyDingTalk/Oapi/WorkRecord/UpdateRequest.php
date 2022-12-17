<?php

namespace SyDingTalk\Oapi\WorkRecord;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.workrecord.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.08
 */
class UpdateRequest extends BaseRequest
{
    /**
     * 待办事项唯一id
     */
    private $recordId;
    /**
     * 用户id
     */
    private $userid;

    public function setRecordId($recordId)
    {
        $this->recordId = $recordId;
        $this->apiParas['record_id'] = $recordId;
    }

    public function getRecordId()
    {
        return $this->recordId;
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
        return 'dingtalk.oapi.workrecord.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->recordId, 'recordId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
