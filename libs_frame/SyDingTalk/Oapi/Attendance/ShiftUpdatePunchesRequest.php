<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.shift.updatepunches request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.05
 */
class ShiftUpdatePunchesRequest extends BaseRequest
{
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 系统自动生成
     */
    private $punches;
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

    public function setPunches($punches)
    {
        $this->punches = $punches;
        $this->apiParas['punches'] = $punches;
    }

    public function getPunches()
    {
        return $this->punches;
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
        return 'dingtalk.oapi.attendance.shift.updatepunches';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->shiftId, 'shiftId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
