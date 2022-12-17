<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.approve.duration.calculate request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.25
 */
class ApproveDurationCalculateRequest extends BaseRequest
{
    /**
     * 审批单类型1：加班，2：出差，3：请假
     */
    private $bizType;
    /**
     * 计算方法，0：按自然日计算，1：按工作日计算
     */
    private $calculateModel;
    /**
     * 时长单位，支持的day,halfDay,hour，biz_type为1时仅支持hour。时间格式必须与时长单位对应，2019-08-15对应day，2019-08-15  AM对应halfDay，2019-08-15 12:43对应hour
     */
    private $durationUnit;
    /**
     * 开始时间，支持的时间格式 2019-08-15/2019-08-15 AM/2019-08-15 12:43。开始时间不能早于当前时间前31天
     */
    private $fromTime;
    /**
     * 结束时间，支持的时间格式 2019-08-15/2019-08-15 AM/2019-08-15 12:43。结束时间减去开始时间的天数不能超过31天。biz_type为1时结束时间减去开始时间不能超过1天
     */
    private $toTime;
    /**
     * 员工的user_id
     */
    private $userid;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setCalculateModel($calculateModel)
    {
        $this->calculateModel = $calculateModel;
        $this->apiParas['calculate_model'] = $calculateModel;
    }

    public function getCalculateModel()
    {
        return $this->calculateModel;
    }

    public function setDurationUnit($durationUnit)
    {
        $this->durationUnit = $durationUnit;
        $this->apiParas['duration_unit'] = $durationUnit;
    }

    public function getDurationUnit()
    {
        return $this->durationUnit;
    }

    public function setFromTime($fromTime)
    {
        $this->fromTime = $fromTime;
        $this->apiParas['from_time'] = $fromTime;
    }

    public function getFromTime()
    {
        return $this->fromTime;
    }

    public function setToTime($toTime)
    {
        $this->toTime = $toTime;
        $this->apiParas['to_time'] = $toTime;
    }

    public function getToTime()
    {
        return $this->toTime;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.approve.duration.calculate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizType, 'bizType');
        RequestCheckUtil::checkNotNull($this->calculateModel, 'calculateModel');
        RequestCheckUtil::checkNotNull($this->durationUnit, 'durationUnit');
        RequestCheckUtil::checkNotNull($this->fromTime, 'fromTime');
        RequestCheckUtil::checkNotNull($this->toTime, 'toTime');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
