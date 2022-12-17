<?php

namespace SyDingTalk\Oapi\ExtContact;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.extcontact.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.09
 */
class GetRequest extends BaseRequest
{
    /**
     * 外部联系人的userId
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
        return 'dingtalk.oapi.extcontact.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userId, 'userId');
        RequestCheckUtil::checkMaxLength($this->userId, 64, 'userId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
