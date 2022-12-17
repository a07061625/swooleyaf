<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.student.comment.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.29
 */
class HomeworkStudentCommentDeleteRequest extends BaseRequest
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
     * 评论ID
     */
    private $commentId;
    /**
     * 作业ID
     */
    private $hwId;
    /**
     * 学生ID
     */
    private $studentId;
    /**
     * 老师UserID
     */
    private $teacherUserid;

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

    public function setCommentId($commentId)
    {
        $this->commentId = $commentId;
        $this->apiParas['comment_id'] = $commentId;
    }

    public function getCommentId()
    {
        return $this->commentId;
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
        return 'dingtalk.oapi.edu.homework.student.comment.delete';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
