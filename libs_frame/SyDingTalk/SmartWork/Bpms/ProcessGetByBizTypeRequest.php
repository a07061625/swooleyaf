<?php

namespace SyDingTalk\SmartWork\Bpms;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.smartwork.bpms.process.getbybiztype request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ProcessGetByBizTypeRequest extends BaseRequest
{
    /**
     * 套件开发时与审批约定的业务标识
     */
    private $bizType;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.smartwork.bpms.process.getbybiztype';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizType, 'bizType');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
