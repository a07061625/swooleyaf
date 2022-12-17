<?php

namespace SyDingTalk\Oapi\Finance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.finance.alipay.account.getbyuid request
 *
 * @author auto create
 *
 * @since 1.0, 2021.10.20
 */
class AlipayAccountGetByUidRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.finance.alipay.account.getbyuid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
