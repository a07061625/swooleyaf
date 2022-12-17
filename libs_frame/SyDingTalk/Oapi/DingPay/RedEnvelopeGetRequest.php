<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.redenvelope.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.20
 */
class RedEnvelopeGetRequest extends BaseRequest
{
    /**
     * 企业订单号
     */
    private $corpBizNo;

    public function setCorpBizNo($corpBizNo)
    {
        $this->corpBizNo = $corpBizNo;
        $this->apiParas['corp_biz_no'] = $corpBizNo;
    }

    public function getCorpBizNo()
    {
        return $this->corpBizNo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.redenvelope.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpBizNo, 'corpBizNo');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
