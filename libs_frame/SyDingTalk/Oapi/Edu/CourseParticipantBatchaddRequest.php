<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.participant.batchadd request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.28
 */
class CourseParticipantBatchaddRequest extends BaseRequest
{
    /**
     * 课程编码集合
     */
    private $courseCodes;
    /**
     * 参与方列表
     */
    private $courseParticipants;
    /**
     * 当前用户ID
     */
    private $opUserid;
    /**
     * 参与方的组织CropId
     */
    private $participantCorpid;

    public function setCourseCodes($courseCodes)
    {
        $this->courseCodes = $courseCodes;
        $this->apiParas['course_codes'] = $courseCodes;
    }

    public function getCourseCodes()
    {
        return $this->courseCodes;
    }

    public function setCourseParticipants($courseParticipants)
    {
        $this->courseParticipants = $courseParticipants;
        $this->apiParas['course_participants'] = $courseParticipants;
    }

    public function getCourseParticipants()
    {
        return $this->courseParticipants;
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

    public function setParticipantCorpid($participantCorpid)
    {
        $this->participantCorpid = $participantCorpid;
        $this->apiParas['participant_corpid'] = $participantCorpid;
    }

    public function getParticipantCorpid()
    {
        return $this->participantCorpid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.participant.batchadd';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->courseCodes, 'courseCodes');
        RequestCheckUtil::checkMaxListSize($this->courseCodes, 10, 'courseCodes');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->participantCorpid, 'participantCorpid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
