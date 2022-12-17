<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.status.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class StatusUpdateRequest extends BaseRequest
{
    /**
     * 系统自动生成
     */
    private $statusChange;

    public function setStatusChange($statusChange)
    {
        $this->statusChange = $statusChange;
        $this->apiParas['status_change'] = $statusChange;
    }

    public function getStatusChange()
    {
        return $this->statusChange;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.status.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
