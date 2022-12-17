<?php

namespace SyDingTalk\Oapi\User;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.user.can_access_microapp request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class CanAccessMicroAppRequest extends BaseRequest
{
    /**
     * 微应用id
     */
    private $appId;
    /**
     * 员工唯一标识ID
     */
    private $userId;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['appId'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['userId'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.user.can_access_microapp';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
