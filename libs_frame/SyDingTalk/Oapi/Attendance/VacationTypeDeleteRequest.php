<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.vacation.type.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class VacationTypeDeleteRequest extends BaseRequest
{
    /**
     * 假期类型唯一标识
     */
    private $leaveCode;
    /**
     * 操作员ID
     */
    private $opUserid;

    public function setLeaveCode($leaveCode)
    {
        $this->leaveCode = $leaveCode;
        $this->apiParas['leave_code'] = $leaveCode;
    }

    public function getLeaveCode()
    {
        return $this->leaveCode;
    }

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.vacation.type.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->leaveCode, 'leaveCode');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
