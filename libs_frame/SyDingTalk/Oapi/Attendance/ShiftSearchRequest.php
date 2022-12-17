<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.shift.search request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.31
 */
class ShiftSearchRequest extends BaseRequest
{
    /**
     * 操作者userId
     */
    private $opUserId;
    /**
     * 班次名称
     */
    private $shiftName;

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setShiftName($shiftName)
    {
        $this->shiftName = $shiftName;
        $this->apiParas['shift_name'] = $shiftName;
    }

    public function getShiftName()
    {
        return $this->shiftName;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.shift.search';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
        RequestCheckUtil::checkNotNull($this->shiftName, 'shiftName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
