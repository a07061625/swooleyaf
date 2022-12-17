<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.ticket.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class TicketCreateRequest extends BaseRequest
{
    /**
     * 工单对象
     */
    private $ticketCreate;

    public function setTicketCreate($ticketCreate)
    {
        $this->ticketCreate = $ticketCreate;
        $this->apiParas['ticket_create'] = $ticketCreate;
    }

    public function getTicketCreate()
    {
        return $this->ticketCreate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.ticket.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
