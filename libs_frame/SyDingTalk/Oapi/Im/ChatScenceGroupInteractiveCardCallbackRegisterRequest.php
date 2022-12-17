<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.interactivecard.callback.register request
 *
 * @author auto create
 *
 * @since 1.0, 2021.06.23
 */
class ChatScenceGroupInteractiveCardCallbackRegisterRequest extends BaseRequest
{
    /**
     * 加密密钥用于校验来源
     */
    private $apiSecret;
    /**
     * callback地址的路由Key，一个key仅可映射一个callbackUrl，不传值企业内部应用默认为orgId，企业三方应用默认为SuiteKey
     */
    private $callbackRouteKey;
    /**
     * 回调地址
     */
    private $callbackUrl;
    /**
     * 是否强制覆盖更新
     */
    private $forceUpdate;

    public function setApiSecret($apiSecret)
    {
        $this->apiSecret = $apiSecret;
        $this->apiParas['api_secret'] = $apiSecret;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function setCallbackRouteKey($callbackRouteKey)
    {
        $this->callbackRouteKey = $callbackRouteKey;
        $this->apiParas['callbackRouteKey'] = $callbackRouteKey;
    }

    public function getCallbackRouteKey()
    {
        return $this->callbackRouteKey;
    }

    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        $this->apiParas['callback_url'] = $callbackUrl;
    }

    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    public function setForceUpdate($forceUpdate)
    {
        $this->forceUpdate = $forceUpdate;
        $this->apiParas['forceUpdate'] = $forceUpdate;
    }

    public function getForceUpdate()
    {
        return $this->forceUpdate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scencegroup.interactivecard.callback.register';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->callbackUrl, 'callbackUrl');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
