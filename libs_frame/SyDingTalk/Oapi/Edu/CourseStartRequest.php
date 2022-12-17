<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.course.start request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.20
 */
class CourseStartRequest extends BaseRequest
{
    /**
     * 需要开始的课程编码
     */
    private $courseCode;
    /**
     * 操作用户id
     */
    private $opUserId;
    /**
     * 开始课程的可选属性设定
     */
    private $startOption;

    public function setCourseCode($courseCode)
    {
        $this->courseCode = $courseCode;
        $this->apiParas['course_code'] = $courseCode;
    }

    public function getCourseCode()
    {
        return $this->courseCode;
    }

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function setStartOption($startOption)
    {
        $this->startOption = $startOption;
        $this->apiParas['start_option'] = $startOption;
    }

    public function getStartOption()
    {
        return $this->startOption;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.course.start';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->courseCode, 'courseCode');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
