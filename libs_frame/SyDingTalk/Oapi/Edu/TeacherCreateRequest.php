<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.teacher.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.15
 */
class TeacherCreateRequest extends BaseRequest
{
    /**
     * 是否班主任；1:班主任；0:非班主任
     */
    private $adviser;
    /**
     * 业务id
     */
    private $bizId;
    /**
     * 班级id
     */
    private $classId;
    /**
     * 钉钉企业管理员
     */
    private $operator;
    /**
     * 老师id
     */
    private $userid;

    public function setAdviser($adviser)
    {
        $this->adviser = $adviser;
        $this->apiParas['adviser'] = $adviser;
    }

    public function getAdviser()
    {
        return $this->adviser;
    }

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

    public function setOperator($operator)
    {
        $this->operator = $operator;
        $this->apiParas['operator'] = $operator;
    }

    public function getOperator()
    {
        return $this->operator;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.teacher.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->adviser, 'adviser');
        RequestCheckUtil::checkNotNull($this->classId, 'classId');
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
