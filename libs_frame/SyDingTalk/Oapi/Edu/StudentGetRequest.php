<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.student.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.09
 */
class StudentGetRequest extends BaseRequest
{
    /**
     * 班级ID
     */
    private $classId;
    /**
     * 学生ID
     */
    private $studentUserid;

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setStudentUserid($studentUserid)
    {
        $this->studentUserid = $studentUserid;
        $this->apiParas['student_userid'] = $studentUserid;
    }

    public function getStudentUserid()
    {
        return $this->studentUserid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.student.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->studentUserid, 'studentUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
