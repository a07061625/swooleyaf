<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.user.bind.sync request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.18
 */
class UserBindSyncRequest extends BaseRequest
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
        return 'dingtalk.oapi.edu.user.bind.sync';
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
