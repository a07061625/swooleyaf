<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.participant.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.20
 */
class CourseParticipantAddRequest extends BaseRequest
{
    /**
     * 课程编码
     */
    private $courseCode;
    /**
     * 当前用户ID
     */
    private $opUserid;
    /**
     * 参与方选项信息
     */
    private $option;
    /**
     * 参与方的组织CropId
     */
    private $participantCorpid;
    /**
     * 参与方ID。participant_type=1时，participant_id表示用户ID；participant_type=2时，participant_id表示部门ID；participant_type=3时，participant_id表示组织ID；
     */
    private $participantId;
    /**
     * 参与方类型。1：用户、2：部门（对应家校通讯录中的班级、年级。详情请参考https://ding-doc.dingtalk.com/doc#/serverapi3/gga05a/z3y0h）、3：组织
     */
    private $participantType;
    /**
     * 参与方角色。student：学生、guardian: 监护人、teacher：老师（注意：授课老师只支持通过课程创建和修改接口，进行添加和修改）
     */
    private $role;

    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
        $this->apiParas['course_code'] = $courseCode;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
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

    public function setOption($option)
    {
        $this->option = $option;
        $this->apiParas['option'] = $option;
    }

    public function getOption()
    {
        return $this->option;
    }

    public function setParticipantCorpid($participantCorpid)
    {
        $this->participantCorpid = $participantCorpid;
        $this->apiParas['participant_corpid'] = $participantCorpid;
    }

    public function getParticipantCorpid()
    {
        return $this->participantCorpid;
    }

    public function setParticipantId($participantId)
    {
        $this->participantId = $participantId;
        $this->apiParas['participant_id'] = $participantId;
    }

    public function getParticipantId()
    {
        return $this->participantId;
    }

    public function setParticipantType($participantType)
    {
        $this->participantType = $participantType;
        $this->apiParas['participant_type'] = $participantType;
    }

    public function getParticipantType()
    {
        return $this->participantType;
    }

    public function setRole($role)
    {
        $this->role = $role;
        $this->apiParas['role'] = $role;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.participant.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->courseCode, 'courseCode');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->participantCorpid, 'participantCorpid');
        RequestCheckUtil::checkNotNull($this->participantId, 'participantId');
        RequestCheckUtil::checkNotNull($this->participantType, 'participantType');
        RequestCheckUtil::checkNotNull($this->role, 'role');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
