<?php

namespace SyDingTalk\Oapi\SmartWork;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartwork.hrm.sms.sendforpayslip request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.17
 */
class HrmSmsSendForPaySlipRequest extends BaseRequest
{
    /**
     * 入参
     */
    private $param;

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartwork.hrm.sms.sendforpayslip';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
