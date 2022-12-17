<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class DeleteRequest extends BaseRequest
{
    /**
     * 员工唯一标识ID（不可修改）
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
        return 'dingtalk.oapi.user.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
