<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.student.topic.record request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.27
 */
class HomeworkStudentTopicRecordRequest extends BaseRequest
{
    /**
     * 答题记录详情
     */
    private $studentAnswerDetails;

    public function setStudentAnswerDetails($studentAnswerDetails)
    {
        $this->studentAnswerDetails = $studentAnswerDetails;
        $this->apiParas['student_answer_details'] = $studentAnswerDetails;
    }

    public function getStudentAnswerDetails()
    {
        return $this->studentAnswerDetails;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.student.topic.record';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
