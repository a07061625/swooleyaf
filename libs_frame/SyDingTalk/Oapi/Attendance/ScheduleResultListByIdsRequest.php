<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.schedule.result.listbyids request
 *
 * @author auto create
 *
 * @since 1.0, 2021.08.26
 */
class ScheduleResultListByIdsRequest extends BaseRequest
{
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 排班ids
     */
    private $scheduleIds;

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setScheduleIds($scheduleIds)
    {
        $this->scheduleIds = $scheduleIds;
        $this->apiParas['schedule_ids'] = $scheduleIds;
    }

    public function getScheduleIds()
    {
        return $this->scheduleIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.schedule.result.listbyids';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->scheduleIds, 'scheduleIds');
        RequestCheckUtil::checkMaxListSize($this->scheduleIds, 100, 'scheduleIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
