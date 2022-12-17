<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.04
 */
class HomeworkCreateRequest extends BaseRequest
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
     * 作业课程名称
     */
    private $courseName;
    /**
     * 作业内容
     */
    private $hwContent;
    /**
     * 截止时间
     */
    private $hwDeadline;
    /**
     * 是否开启截止时间
     */
    private $hwDeadlineOpen;
    /**
     * 作业视频
     */
    private $hwMedia;
    /**
     * 作业图片
     */
    private $hwPhoto;
    /**
     * 作业标题
     */
    private $hwTitle;
    /**
     * 作业类型
     */
    private $hwType;
    /**
     * 作业录音
     */
    private $hwVideo;
    /**
     * 幂等ID字段
     */
    private $identifier;
    /**
     * 是否开始定时调度
     */
    private $scheduledRelease;
    /**
     * 定时调度时间
     */
    private $scheduledTime;
    /**
     * 选择的布置班级
     */
    private $selectClass;
    /**
     * 选择班级对应学生
     */
    private $selectStu;
    /**
     * 状态
     */
    private $status;
    /**
     * 发送对象
     */
    private $targetRole;
    /**
     * 老师名称
     */
    private $teacherName;
    /**
     * 老师userid
     */
    private $teacherUserid;

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

    public function setCourseName($courseName)
    {
        $this->courseName = $courseName;
        $this->apiParas['course_name'] = $courseName;
    }

    public function getCourseName()
    {
        return $this->courseName;
    }

    public function setHwContent($hwContent)
    {
        $this->hwContent = $hwContent;
        $this->apiParas['hw_content'] = $hwContent;
    }

    public function getHwContent()
    {
        return $this->hwContent;
    }

    public function setHwDeadline($hwDeadline)
    {
        $this->hwDeadline = $hwDeadline;
        $this->apiParas['hw_deadline'] = $hwDeadline;
    }

    public function getHwDeadline()
    {
        return $this->hwDeadline;
    }

    public function setHwDeadlineOpen($hwDeadlineOpen)
    {
        $this->hwDeadlineOpen = $hwDeadlineOpen;
        $this->apiParas['hw_deadline_open'] = $hwDeadlineOpen;
    }

    public function getHwDeadlineOpen()
    {
        return $this->hwDeadlineOpen;
    }

    public function setHwMedia($hwMedia)
    {
        $this->hwMedia = $hwMedia;
        $this->apiParas['hw_media'] = $hwMedia;
    }

    public function getHwMedia()
    {
        return $this->hwMedia;
    }

    public function setHwPhoto($hwPhoto)
    {
        $this->hwPhoto = $hwPhoto;
        $this->apiParas['hw_photo'] = $hwPhoto;
    }

    public function getHwPhoto()
    {
        return $this->hwPhoto;
    }

    public function setHwTitle($hwTitle)
    {
        $this->hwTitle = $hwTitle;
        $this->apiParas['hw_title'] = $hwTitle;
    }

    public function getHwTitle()
    {
        return $this->hwTitle;
    }

    public function setHwType($hwType)
    {
        $this->hwType = $hwType;
        $this->apiParas['hw_type'] = $hwType;
    }

    public function getHwType()
    {
        return $this->hwType;
    }

    public function setHwVideo($hwVideo)
    {
        $this->hwVideo = $hwVideo;
        $this->apiParas['hw_video'] = $hwVideo;
    }

    public function getHwVideo()
    {
        return $this->hwVideo;
    }

    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        $this->apiParas['identifier'] = $identifier;
    }

    public function getIdentifier()
    {
        return $this->identifier;
    }

    public function setScheduledRelease($scheduledRelease)
    {
        $this->scheduledRelease = $scheduledRelease;
        $this->apiParas['scheduled_release'] = $scheduledRelease;
    }

    public function getScheduledRelease()
    {
        return $this->scheduledRelease;
    }

    public function setScheduledTime($scheduledTime)
    {
        $this->scheduledTime = $scheduledTime;
        $this->apiParas['scheduled_time'] = $scheduledTime;
    }

    public function getScheduledTime()
    {
        return $this->scheduledTime;
    }

    public function setSelectClass($selectClass)
    {
        $this->selectClass = $selectClass;
        $this->apiParas['select_class'] = $selectClass;
    }

    public function getSelectClass()
    {
        return $this->selectClass;
    }

    public function setSelectStu($selectStu)
    {
        $this->selectStu = $selectStu;
        $this->apiParas['select_stu'] = $selectStu;
    }

    public function getSelectStu()
    {
        return $this->selectStu;
    }

    public function setStatus($status)
    {
        $this->status = $status;
        $this->apiParas['status'] = $status;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function setTargetRole($targetRole)
    {
        $this->targetRole = $targetRole;
        $this->apiParas['target_role'] = $targetRole;
    }

    public function getTargetRole()
    {
        return $this->targetRole;
    }

    public function setTeacherName($teacherName)
    {
        $this->teacherName = $teacherName;
        $this->apiParas['teacher_name'] = $teacherName;
    }

    public function getTeacherName()
    {
        return $this->teacherName;
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
        return 'dingtalk.oapi.edu.homework.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->courseName, 'courseName');
        RequestCheckUtil::checkNotNull($this->hwContent, 'hwContent');
        RequestCheckUtil::checkNotNull($this->hwTitle, 'hwTitle');
        RequestCheckUtil::checkNotNull($this->identifier, 'identifier');
        RequestCheckUtil::checkNotNull($this->status, 'status');
        RequestCheckUtil::checkNotNull($this->teacherName, 'teacherName');
        RequestCheckUtil::checkNotNull($this->teacherUserid, 'teacherUserid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
