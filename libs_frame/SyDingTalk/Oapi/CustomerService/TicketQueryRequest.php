<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.ticket.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class TicketQueryRequest extends BaseRequest
{
    /**
     * 查询对象
     */
    private $ticketPageQueryDto;

    public function setTicketPageQueryDto($ticketPageQueryDto)
    {
        $this->ticketPageQueryDto = $ticketPageQueryDto;
        $this->apiParas['ticket_page_query_dto'] = $ticketPageQueryDto;
    }

    public function getTicketPageQueryDto()
    {
        return $this->ticketPageQueryDto;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.ticket.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
