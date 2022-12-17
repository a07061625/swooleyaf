<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.student.report.submit request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.28
 */
class HomeworkStudentReportSubmitRequest extends BaseRequest
{
    /**
     * 扩展属性
     */
    private $attributes;
    /**
     * 业务编码
     */
    private $bizCode;
    /**
     * 部门ID
     */
    private $classId;
    /**
     * 作业ID
     */
    private $hwId;
    /**
     * 作业报告
     */
    private $hwReport;
    /**
     * 作业结果
     */
    private $hwResult;
    /**
     * 学生ID
     */
    private $studentId;
    /**
     * 学生姓名
     */
    private $studentName;

    public function setAttributes($attributes)
    {
        $this->attributes = $attributes;
        $this->apiParas['attributes'] = $attributes;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setClassId($classId)
    {
        $this->classId = $classId;
        $this->apiParas['class_id'] = $classId;
    }

    public function getClassId()
    {
        return $this->classId;
    }

    public function setHwId($hwId)
    {
        $this->hwId = $hwId;
        $this->apiParas['hw_id'] = $hwId;
    }

    public function getHwId()
    {
        return $this->hwId;
    }

    public function setHwReport($hwReport)
    {
        $this->hwReport = $hwReport;
        $this->apiParas['hw_report'] = $hwReport;
    }

    public function getHwReport()
    {
        return $this->hwReport;
    }

    public function setHwResult($hwResult)
    {
        $this->hwResult = $hwResult;
        $this->apiParas['hw_result'] = $hwResult;
    }

    public function getHwResult()
    {
        return $this->hwResult;
    }

    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
        $this->apiParas['student_id'] = $studentId;
    }

    public function getStudentId()
    {
        return $this->studentId;
    }

    public function setStudentName($studentName)
    {
        $this->studentName = $studentName;
        $this->apiParas['student_name'] = $studentName;
    }

    public function getStudentName()
    {
        return $this->studentName;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.student.report.submit';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->hwId, 'hwId');
        RequestCheckUtil::checkNotNull($this->studentId, 'studentId');
        RequestCheckUtil::checkNotNull($this->studentName, 'studentName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
