<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.10
 */
class CourseUpdateRequest extends BaseRequest
{
    /**
     * 课程唯一编码
     */
    private $courseCode;
    /**
     * 课程的结束时间，Unix毫秒时间戳
     */
    private $endTime;
    /**
     * 课程介绍
     */
    private $introduce;
    /**
     * 课程名称
     */
    private $name;
    /**
     * 当前用户ID
     */
    private $opUserid;
    /**
     * 课程的开始时间，Unix毫秒时间戳
     */
    private $startTime;
    /**
     * 老师的组织CorpId
     */
    private $teacherCorpid;
    /**
     * 老师的用户ID
     */
    private $teacherUserid;

    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
        $this->apiParas['course_code'] = $courseCode;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
    }

    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
        $this->apiParas['end_time'] = $endTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function setIntroduce($introduce)
    {
        $this->introduce = $introduce;
        $this->apiParas['introduce'] = $introduce;
    }

    public function getIntroduce()
    {
        return $this->introduce;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
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

    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
        $this->apiParas['start_time'] = $startTime;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function setTeacherCorpid($teacherCorpid)
    {
        $this->teacherCorpid = $teacherCorpid;
        $this->apiParas['teacher_corpid'] = $teacherCorpid;
    }

    public function getTeacherCorpid()
    {
        return $this->teacherCorpid;
    }

    public function setTeacherUserid($teacherUserid)
    {
        $this->teacherUserid = $teacherUserid;
        $this->apiParas['teacher_userid'] = $teacherUserid;
    }

    public function getTeacherUserid()
    {
        return $this->teacherUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->courseCode, 'courseCode');
        RequestCheckUtil::checkMaxLength($this->introduce, 120, 'introduce');
        RequestCheckUtil::checkMaxLength($this->name, 64, 'name');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
