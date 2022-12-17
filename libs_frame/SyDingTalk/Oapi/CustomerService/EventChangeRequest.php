<?php

namespace SyDingTalk\Oapi\CustomerService;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.customerservice.event.change request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.29
 */
class EventChangeRequest extends BaseRequest
{
    /**
     * 事件对象
     */
    private $eventDto;

    public function setEventDto($eventDto)
    {
        $this->eventDto = $eventDto;
        $this->apiParas['event_dto'] = $eventDto;
    }

    public function getEventDto()
    {
        return $this->eventDto;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.customerservice.event.change';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
