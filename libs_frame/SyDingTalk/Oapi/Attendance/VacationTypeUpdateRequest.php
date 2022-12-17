<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.vacation.type.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.27
 */
class VacationTypeUpdateRequest extends BaseRequest
{
    /**
     * 假期类型，普通假期或者加班转调休假期。(general_leave、lieu_leave其中一种)
     */
    private $bizType;
    /**
     * 调休假有效期规则(validity_type:有效类型 absolute_time(绝对时间)、relative_time(相对时间)其中一种 validity_value:延长日期(当validity_type为absolute_time该值该值不为空且满足yy-mm格式 validity_type为relative_time该值为大于1的整数))
     */
    private $extras;
    /**
     * 每天折算的工作时长(百分之一 例如1天=10小时=1000)
     */
    private $hoursInPerDay;
    /**
     * 请假证明类
     */
    private $leaveCertificate;
    /**
     * 假期类型唯一标识
     */
    private $leaveCode;
    /**
     * 取整，up或者down
     */
    private $leaveHourCeil;
    /**
     * 假期名称
     */
    private $leaveName;
    /**
     * 是否开启请假时长是否向上取整
     */
    private $leaveTimeCeil;
    /**
     * 请假时长向上取整时的最小时长单位：hour-不足1小时按照1小时计算；halfHour-不足半小时按照半小时计算
     */
    private $leaveTimeCeilMinUnit;
    /**
     * 请假单位，可以按照天半天或者小时请假。(day、halfDay、hour其中一种)
     */
    private $leaveViewUnit;
    /**
     * 最大请假时间
     */
    private $maxLeaveTime;
    /**
     * 请假时，最小请假时长（请假单位为hour时生效），请假时长小于该值时自动取该值，有效值：[0, 23]
     */
    private $minLeaveHour;
    /**
     * 是否按照自然日统计请假时长，当为false的时候，用户发起请假时候会根据用户在请假时间段内的排班情况来计算请假时长。
     */
    private $naturalDayLeave;
    /**
     * 操作者ID
     */
    private $opUserid;
    /**
     * 是否带薪假期
     */
    private $paidLeave;
    /**
     * 限时提交规则
     */
    private $submitTimeRule;
    /**
     * 适用范围规则列表：哪些部门/员工可以使用该假期类型，不传默认为全公司
     */
    private $visibilityRules;
    /**
     * 新员工请假：何时可以请假（entry-入职开始 、formal-转正后）
     */
    private $whenCanLeave;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setExtras($extras)
    {
        $this->extras = $extras;
        $this->apiParas['extras'] = $extras;
    }

    public function getExtras()
    {
        return $this->extras;
    }

    public function setHoursInPerDay($hoursInPerDay)
    {
        $this->hoursInPerDay = $hoursInPerDay;
        $this->apiParas['hours_in_per_day'] = $hoursInPerDay;
    }

    public function getHoursInPerDay()
    {
        return $this->hoursInPerDay;
    }

    public function setLeaveCertificate($leaveCertificate)
    {
        $this->leaveCertificate = $leaveCertificate;
        $this->apiParas['leave_certificate'] = $leaveCertificate;
    }

    public function getLeaveCertificate()
    {
        return $this->leaveCertificate;
    }

    public function setLeaveCode($leaveCode)
    {
        $this->leaveCode = $leaveCode;
        $this->apiParas['leave_code'] = $leaveCode;
    }

    public function getLeaveCode()
    {
        return $this->leaveCode;
    }

    public function setLeaveHourCeil($leaveHourCeil)
    {
        $this->leaveHourCeil = $leaveHourCeil;
        $this->apiParas['leave_hour_ceil'] = $leaveHourCeil;
    }

    public function getLeaveHourCeil()
    {
        return $this->leaveHourCeil;
    }

    public function setLeaveName($leaveName)
    {
        $this->leaveName = $leaveName;
        $this->apiParas['leave_name'] = $leaveName;
    }

    public function getLeaveName()
    {
        return $this->leaveName;
    }

    public function setLeaveTimeCeil($leaveTimeCeil)
    {
        $this->leaveTimeCeil = $leaveTimeCeil;
        $this->apiParas['leave_time_ceil'] = $leaveTimeCeil;
    }

    public function getLeaveTimeCeil()
    {
        return $this->leaveTimeCeil;
    }

    public function setLeaveTimeCeilMinUnit($leaveTimeCeilMinUnit)
    {
        $this->leaveTimeCeilMinUnit = $leaveTimeCeilMinUnit;
        $this->apiParas['leave_time_ceil_min_unit'] = $leaveTimeCeilMinUnit;
    }

    public function getLeaveTimeCeilMinUnit()
    {
        return $this->leaveTimeCeilMinUnit;
    }

    public function setLeaveViewUnit($leaveViewUnit)
    {
        $this->leaveViewUnit = $leaveViewUnit;
        $this->apiParas['leave_view_unit'] = $leaveViewUnit;
    }

    public function getLeaveViewUnit()
    {
        return $this->leaveViewUnit;
    }

    public function setMaxLeaveTime($maxLeaveTime)
    {
        $this->maxLeaveTime = $maxLeaveTime;
        $this->apiParas['max_leave_time'] = $maxLeaveTime;
    }

    public function getMaxLeaveTime()
    {
        return $this->maxLeaveTime;
    }

    public function setMinLeaveHour($minLeaveHour)
    {
        $this->minLeaveHour = $minLeaveHour;
        $this->apiParas['min_leave_hour'] = $minLeaveHour;
    }

    public function getMinLeaveHour()
    {
        return $this->minLeaveHour;
    }

    public function setNaturalDayLeave($naturalDayLeave)
    {
        $this->naturalDayLeave = $naturalDayLeave;
        $this->apiParas['natural_day_leave'] = $naturalDayLeave;
    }

    public function getNaturalDayLeave()
    {
        return $this->naturalDayLeave;
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

    public function setPaidLeave($paidLeave)
    {
        $this->paidLeave = $paidLeave;
        $this->apiParas['paid_leave'] = $paidLeave;
    }

    public function getPaidLeave()
    {
        return $this->paidLeave;
    }

    public function setSubmitTimeRule($submitTimeRule)
    {
        $this->submitTimeRule = $submitTimeRule;
        $this->apiParas['submit_time_rule'] = $submitTimeRule;
    }

    public function getSubmitTimeRule()
    {
        return $this->submitTimeRule;
    }

    public function setVisibilityRules($visibilityRules)
    {
        $this->visibilityRules = $visibilityRules;
        $this->apiParas['visibility_rules'] = $visibilityRules;
    }

    public function getVisibilityRules()
    {
        return $this->visibilityRules;
    }

    public function setWhenCanLeave($whenCanLeave)
    {
        $this->whenCanLeave = $whenCanLeave;
        $this->apiParas['when_can_leave'] = $whenCanLeave;
    }

    public function getWhenCanLeave()
    {
        return $this->whenCanLeave;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.vacation.type.update';
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
