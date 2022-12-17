<?php

namespace SyDingTalk\Oapi\V2Safe;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.v2.safe.setdisable request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.01
 */
class SetDisableRequest extends BaseRequest
{
    /**
     * 冻结原因
     */
    private $reason;
    /**
     * 员工id
     */
    private $userid;

    public function setReason($reason)
    {
        $this->reason = $reason;
        $this->apiParas['reason'] = $reason;
    }

    public function getReason()
    {
        return $this->reason;
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
        return 'dingtalk.oapi.v2.safe.setdisable';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->reason, 'reason');
        RequestCheckUtil::checkMaxLength($this->reason, 20, 'reason');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
        RequestCheckUtil::checkMaxLength($this->userid, 64, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
