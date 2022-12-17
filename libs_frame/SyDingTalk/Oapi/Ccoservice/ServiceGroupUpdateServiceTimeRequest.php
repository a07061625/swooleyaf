<?php

namespace SyDingTalk\Oapi\Ccoservice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ccoservice.servicegroup.updateservicetime request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ServiceGroupUpdateServiceTimeRequest extends BaseRequest
{
    /**
     * 服务结束时间
     */
    private $endTime;
    /**
     * 群加密id
     */
    private $openConversationId;
    /**
     * 服务开始时间
     */
    private $startTime;
    /**
     * 日期类型,0-工作日;1-每日;99-端上不显示
     */
    private $timeType;

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setTimeType($timeType)
    {
        $this->timeType = $timeType;
        $this->apiParas['time_type'] = $timeType;
    }

    public function getTimeType()
    {
        return $this->timeType;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ccoservice.servicegroup.updateservicetime';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->endTime, 'endTime');
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkNotNull($this->startTime, 'startTime');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
