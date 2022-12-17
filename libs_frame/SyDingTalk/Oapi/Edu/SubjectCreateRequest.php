<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.subject.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.14
 */
class SubjectCreateRequest extends BaseRequest
{
    /**
     * 操作人userId
     */
    private $operatorUserid;
    /**
     * 学段编码
     */
    private $periodCode;
    /**
     * 学科编码
     */
    private $subjectCode;
    /**
     * 学科名称
     */
    private $subjectName;

    public function setOperatorUserid($operatorUserid)
    {
        $this->operatorUserid = $operatorUserid;
        $this->apiParas['operator_userid'] = $operatorUserid;
    }

    public function getOperatorUserid()
    {
        return $this->operatorUserid;
    }

    public function setPeriodCode($periodCode)
    {
        $this->periodCode = $periodCode;
        $this->apiParas['period_code'] = $periodCode;
    }

    public function getPeriodCode()
    {
        return $this->periodCode;
    }

    public function setSubjectCode($subjectCode)
    {
        $this->subjectCode = $subjectCode;
        $this->apiParas['subject_code'] = $subjectCode;
    }

    public function getSubjectCode()
    {
        return $this->subjectCode;
    }

    public function setSubjectName($subjectName)
    {
        $this->subjectName = $subjectName;
        $this->apiParas['subject_name'] = $subjectName;
    }

    public function getSubjectName()
    {
        return $this->subjectName;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.subject.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operatorUserid, 'operatorUserid');
        RequestCheckUtil::checkNotNull($this->periodCode, 'periodCode');
        RequestCheckUtil::checkNotNull($this->subjectCode, 'subjectCode');
        RequestCheckUtil::checkNotNull($this->subjectName, 'subjectName');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
