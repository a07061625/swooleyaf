<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.menu.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.14
 */
class MenuGetRequest extends BaseRequest
{
    /**
     * 0:PC端导航 1：手机端导航
     */
    private $clientType;

    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
        $this->apiParas['client_type'] = $clientType;
    }

    public function getClientType()
    {
        return $this->clientType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.menu.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->clientType, 'clientType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
