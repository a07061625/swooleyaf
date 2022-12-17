<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.shift.add request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.30
 */
class ShiftAddRequest extends BaseRequest
{
    /**
     * 操作人
     */
    private $opUserId;
    /**
     * 班次
     */
    private $shift;

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setShift($shift)
    {
        $this->shift = $shift;
        $this->apiParas['shift'] = $shift;
    }

    public function getShift()
    {
        return $this->shift;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.shift.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
