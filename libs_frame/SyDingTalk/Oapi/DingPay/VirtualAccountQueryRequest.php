<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingpay.virtualaccount.query request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class VirtualAccountQueryRequest extends BaseRequest
{
    /**
     * 扩展属性
     */
    private $extension;

    public function setExtension($extension)
    {
        $this->extension = $extension;
        $this->apiParas['extension'] = $extension;
    }

    public function getExtension()
    {
        return $this->extension;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.virtualaccount.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
