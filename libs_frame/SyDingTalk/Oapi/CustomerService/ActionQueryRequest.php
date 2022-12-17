<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.action.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class ActionQueryRequest extends BaseRequest
{
    /**
     * 分页查询条件
     */
    private $ticketActionPageQuery;

    public function setTicketActionPageQuery($ticketActionPageQuery)
    {
        $this->ticketActionPageQuery = $ticketActionPageQuery;
        $this->apiParas['ticket_action_page_query'] = $ticketActionPageQuery;
    }

    public function getTicketActionPageQuery()
    {
        return $this->ticketActionPageQuery;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.action.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
