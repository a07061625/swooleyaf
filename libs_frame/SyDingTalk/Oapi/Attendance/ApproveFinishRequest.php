<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.approve.finish request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.03
 */
class ApproveFinishRequest extends BaseRequest
{
    /**
     * 审批单全局唯一id，最大长度100个字符
     */
    private $approveId;
    /**
     * 审批单类型1:加班，2：外出、出差，3：请假
     */
    private $bizType;
    /**
     * 计算方法，0：按自然日计算，1：按工作日计算
     */
    private $calculateModel;
    /**
     * 钉钉侧审批单全局唯一id，最大长度64个字符
     */
    private $dingtalkApproveId;
    /**
     * 时长单位，支持的day,halfDay,hour，biz_type为1时仅支持hour。时间格式必须与时长单位对应，2019-08-15对应day，2019-08-15  AM对应halfDay，2019-08-15 12:43对应hour
     */
    private $durationUnit;
    /**
     * 开始时间，支持的时间格式 2019-08-15/2019-08-15 AM/2019-08-15 12:43。开始时间不能早于当前时间前31天
     */
    private $fromTime;
    /**
     * 审批单跳转地址，最大长度100个字符
     */
    private $jumpUrl;
    /**
     * biz_type为1时必传，加班时长单位小时
     */
    private $overtimeDuration;
    /**
     * biz_type为1时必传，1：加班转调休，2：加班转工资
     */
    private $overtimeToMore;
    /**
     * 子类型名称，最大长度20个字符
     */
    private $subType;
    /**
     * 审批单类型名称，最大长度20个字符
     */
    private $tagName;
    /**
     * 结束时间，支持的时间格式 2019-08-15/2019-08-15 AM/2019-08-15 12:43。结束时间减去开始时间的天数不能超过31天。biz_type为1时结束时间减去开始时间不能超过1天
     */
    private $toTime;
    /**
     * 员工的user_id
     */
    private $userid;

    public function setApproveId($approveId)
    {
        $this->approveId = $approveId;
        $this->apiParas['approve_id'] = $approveId;
    }

    public function getApproveId()
    {
        return $this->approveId;
    }

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

    public function setDingtalkApproveId($dingtalkApproveId)
    {
        $this->dingtalkApproveId = $dingtalkApproveId;
        $this->apiParas['dingtalk_approve_id'] = $dingtalkApproveId;
    }

    public function getDingtalkApproveId()
    {
        return $this->dingtalkApproveId;
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

    public function setJumpUrl($jumpUrl)
    {
        $this->jumpUrl = $jumpUrl;
        $this->apiParas['jump_url'] = $jumpUrl;
    }

    public function getJumpUrl()
    {
        return $this->jumpUrl;
    }

    public function setOvertimeDuration($overtimeDuration)
    {
        $this->overtimeDuration = $overtimeDuration;
        $this->apiParas['overtime_duration'] = $overtimeDuration;
    }

    public function getOvertimeDuration()
    {
        return $this->overtimeDuration;
    }

    public function setOvertimeToMore($overtimeToMore)
    {
        $this->overtimeToMore = $overtimeToMore;
        $this->apiParas['overtime_to_more'] = $overtimeToMore;
    }

    public function getOvertimeToMore()
    {
        return $this->overtimeToMore;
    }

    public function setSubType($subType)
    {
        $this->subType = $subType;
        $this->apiParas['sub_type'] = $subType;
    }

    public function getSubType()
    {
        return $this->subType;
    }

    public function setTagName($tagName)
    {
        $this->tagName = $tagName;
        $this->apiParas['tag_name'] = $tagName;
    }

    public function getTagName()
    {
        return $this->tagName;
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
        return 'dingtalk.oapi.attendance.approve.finish';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxLength($this->approveId, 100, 'approveId');
        RequestCheckUtil::checkMaxLength($this->dingtalkApproveId, 64, 'dingtalkApproveId');
        RequestCheckUtil::checkMaxLength($this->jumpUrl, 200, 'jumpUrl');
        RequestCheckUtil::checkMaxLength($this->subType, 20, 'subType');
        RequestCheckUtil::checkMaxLength($this->tagName, 20, 'tagName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
