<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.student.comment.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.28
 */
class HomeworkStudentCommentCreateRequest extends BaseRequest
{
    /**
     * 属性参数
     */
    private $attributes;
    /**
     * 业务编码
     */
    private $bizCode;
    /**
     * 班级ID
     */
    private $classId;
    /**
     * 评论
     */
    private $comment;
    /**
     * 作业ID
     */
    private $hwId;
    /**
     * 老师评论视频
     */
    private $media;
    /**
     * 老师评论图片
     */
    private $photo;
    /**
     * 学生ID
     */
    private $studentId;
    /**
     * 学生姓名
     */
    private $studentName;
    /**
     * 老师UserId
     */
    private $teacherUserid;
    /**
     * 老师评论语音
     */
    private $video;

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

    public function setComment($comment)
    {
        $this->comment = $comment;
        $this->apiParas['comment'] = $comment;
    }

    public function getComment()
    {
        return $this->comment;
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

    public function setMedia($media)
    {
        $this->media = $media;
        $this->apiParas['media'] = $media;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setPhoto($photo)
    {
        $this->photo = $photo;
        $this->apiParas['photo'] = $photo;
    }

    public function getPhoto()
    {
        return $this->photo;
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

    public function setTeacherUserid($teacherUserid)
    {
        $this->teacherUserid = $teacherUserid;
        $this->apiParas['teacher_userid'] = $teacherUserid;
    }

    public function getTeacherUserid()
    {
        return $this->teacherUserid;
    }

    public function setVideo($video)
    {
        $this->video = $video;
        $this->apiParas['video'] = $video;
    }

    public function getVideo()
    {
        return $this->video;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.student.comment.create';
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
        RequestCheckUtil::checkNotNull($this->teacherUserid, 'teacherUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
