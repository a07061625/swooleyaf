<?php

namespace SyDingTalk\Oapi\Hrm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hrm.employee.delresumerecord request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class EmployeeDelResumeRecordRequest extends BaseRequest
{
    /**
     * 成长记录唯一标识
     */
    private $resumeId;
    /**
     * 员工userid
     */
    private $userid;

    public function setResumeId($resumeId)
    {
        $this->resumeId = $resumeId;
        $this->apiParas['resume_id'] = $resumeId;
    }

    public function getResumeId()
    {
        return $this->resumeId;
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
        return 'dingtalk.oapi.hrm.employee.delresumerecord';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->resumeId, 'resumeId');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
