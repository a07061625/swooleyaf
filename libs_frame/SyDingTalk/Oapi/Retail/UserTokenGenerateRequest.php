<?php

namespace SyDingTalk\Oapi\Retail;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.retail.user.token.generate request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.09
 */
class UserTokenGenerateRequest extends BaseRequest
{
    /**
     * 业务身份
     */
    private $channel;
    /**
     * xx
     */
    private $request;

    public function setChannel($channel)
    {
        $this->channel = $channel;
        $this->apiParas['channel'] = $channel;
    }

    public function getChannel()
    {
        return $this->channel;
    }

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas['request'] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.retail.user.token.generate';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
