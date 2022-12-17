<?php

namespace SyDingTalk\SmartWork\BlackBoard;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.blackboard.listtopten request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ListTopTenRequest extends BaseRequest
{
    /**
     * 用户id
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
        return 'dingtalk.smartwork.blackboard.listtopten';
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
