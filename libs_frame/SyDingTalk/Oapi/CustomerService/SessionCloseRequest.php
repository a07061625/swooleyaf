<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.session.close request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class SessionCloseRequest extends BaseRequest
{
    /**
     * 关闭会话
     */
    private $closeSession;

    public function setCloseSession($closeSession)
    {
        $this->closeSession = $closeSession;
        $this->apiParas['close_session'] = $closeSession;
    }

    public function getCloseSession()
    {
        return $this->closeSession;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.session.close';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
