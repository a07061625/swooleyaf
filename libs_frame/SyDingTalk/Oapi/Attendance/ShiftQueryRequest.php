<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.shift.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.26
 */
class ShiftQueryRequest extends BaseRequest
{
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 班次id
     */
    private $shiftId;

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setShiftId($shiftId)
    {
        $this->shiftId = $shiftId;
        $this->apiParas['shift_id'] = $shiftId;
    }

    public function getShiftId()
    {
        return $this->shiftId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.shift.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
