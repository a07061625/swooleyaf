<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.student.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.11.05
 */
class StudentCreateRequest extends BaseRequest
{
    /**
     * 业务唯一id
     */
    private $bizId;
    /**
     * 班级id
     */
    private $classId;
    /**
     * 学生手机号
     */
    private $mobile;
    /**
     * 学生名
     */
    private $name;
    /**
     * 钉钉企业管理员
     */
    private $operator;
    /**
     * 学号
     */
    private $studentNo;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
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

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->apiParas['mobile'] = $mobile;
    }

    public function getMobile()
    {
        return $this->mobile;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setOperator($operator)
    {
        $this->operator = $operator;
        $this->apiParas['operator'] = $operator;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setStudentNo($studentNo)
    {
        $this->studentNo = $studentNo;
        $this->apiParas['student_no'] = $studentNo;
    }

    public function getStudentNo()
    {
        return $this->studentNo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.student.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->name, 'name');
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
