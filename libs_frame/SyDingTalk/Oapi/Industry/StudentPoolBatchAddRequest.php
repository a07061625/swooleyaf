<?php

namespace SyDingTalk\Oapi\Industry;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.industry.studentpool.batchadd request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.14
 */
class StudentPoolBatchAddRequest extends BaseRequest
{
    /**
     * 业务code
     */
    private $bizCode;
    /**
     * 学员列表
     */
    private $studentList;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setStudentList($studentList)
    {
        $this->studentList = $studentList;
        $this->apiParas['student_list'] = $studentList;
    }

    public function getStudentList()
    {
        return $this->studentList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.industry.studentpool.batchadd';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
