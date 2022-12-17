<?php

namespace SyDingTalk\SmartWork\Attends;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.attends.getusergroup request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.28
 */
class GetUserGroupRequest extends BaseRequest
{
    /**
     * 员工在企业内的UserID，企业用来唯一标识用户的字段。
     */
    private $userid;

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
        return 'dingtalk.smartwork.attends.getusergroup';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
