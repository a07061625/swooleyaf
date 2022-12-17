<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.student.mark.tag request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.03
 */
class HomeworkStudentMarkTagRequest extends BaseRequest
{
    /**
     * 业务编码
     */
    private $bizCode;
    /**
     * 班级ID
     */
    private $classId;
    /**
     * 作业ID
     */
    private $hwId;
    /**
     * 学生userid
     */
    private $studentId;
    /**
     * 学生姓名
     */
    private $studentName;
    /**
     * 作业标记：优秀、良好、差
     */
    private $tag;
    /**
     * 老师userid
     */
    private $teacherId;
    /**
     * 文本内容
     */
    private $text;

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

    public function setTag($tag)
    {
        $this->tag = $tag;
        $this->apiParas['tag'] = $tag;
    }

    public function getTag()
    {
        return $this->tag;
    }

    public function setTeacherId($teacherId)
    {
        $this->teacherId = $teacherId;
        $this->apiParas['teacher_id'] = $teacherId;
    }

    public function getTeacherId()
    {
        return $this->teacherId;
    }

    public function setText($text)
    {
        $this->text = $text;
        $this->apiParas['text'] = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.student.mark.tag';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
