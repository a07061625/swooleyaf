<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.session.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class SessionCreateRequest extends BaseRequest
{
    /**
     * 新建会话参数
     */
    private $createSession;

    public function setCreateSession($createSession)
    {
        $this->createSession = $createSession;
        $this->apiParas['create_session'] = $createSession;
    }

    public function getCreateSession()
    {
        return $this->createSession;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.session.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
