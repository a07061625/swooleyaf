<?php

namespace SyDingTalk\Oapi\ExtContact;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.extcontact.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class DeleteRequest extends BaseRequest
{
    /**
     * userId
     */
    private $userId;

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.extcontact.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userId, 'userId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
