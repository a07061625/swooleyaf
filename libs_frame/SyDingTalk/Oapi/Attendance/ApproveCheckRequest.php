<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.approve.check request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.30
 */
class ApproveCheckRequest extends BaseRequest
{
    /**
     * 审批单id，全局唯一
     */
    private $approveId;
    /**
     * 审批单跳转地址
     */
    private $jumpUrl;
    /**
     * 排班时间
     */
    private $punchCheckTime;
    /**
     * 要补的排班id
     */
    private $punchId;
    /**
     * 审批单名称
     */
    private $tagName;
    /**
     * 用户打卡时间
     */
    private $userCheckTime;
    /**
     * 员工的user_id
     */
    private $userid;
    /**
     * 要补哪一天的卡，注意这个日期不是实际要补的日期，而是班次的日期。例如用户要补卡的时间是2019-08-16 00:20，排班时间是2019-08-15 23：50，那么这里要传的日期是2019-08-15
     */
    private $workDate;

    public function setApproveId($approveId)
    {
        $this->approveId = $approveId;
        $this->apiParas['approve_id'] = $approveId;
    }

    public function getApproveId()
    {
        return $this->approveId;
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

    public function setPunchCheckTime($punchCheckTime)
    {
        $this->punchCheckTime = $punchCheckTime;
        $this->apiParas['punch_check_time'] = $punchCheckTime;
    }

    public function getPunchCheckTime()
    {
        return $this->punchCheckTime;
    }

    public function setPunchId($punchId)
    {
        $this->punchId = $punchId;
        $this->apiParas['punch_id'] = $punchId;
    }

    public function getPunchId()
    {
        return $this->punchId;
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

    public function setUserCheckTime($userCheckTime)
    {
        $this->userCheckTime = $userCheckTime;
        $this->apiParas['user_check_time'] = $userCheckTime;
    }

    public function getUserCheckTime()
    {
        return $this->userCheckTime;
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

    public function setWorkDate($workDate)
    {
        $this->workDate = $workDate;
        $this->apiParas['work_date'] = $workDate;
    }

    public function getWorkDate()
    {
        return $this->workDate;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.approve.check';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
