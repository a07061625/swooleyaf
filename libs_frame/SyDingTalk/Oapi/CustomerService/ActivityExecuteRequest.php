<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.activity.execute request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class ActivityExecuteRequest extends BaseRequest
{
    /**
     * 活动
     */
    private $ticketActivity;

    public function setTicketActivity($ticketActivity)
    {
        $this->ticketActivity = $ticketActivity;
        $this->apiParas['ticket_activity'] = $ticketActivity;
    }

    public function getTicketActivity()
    {
        return $this->ticketActivity;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.activity.execute';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
