<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.grade.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.31
 */
class GradeCreateRequest extends BaseRequest
{
    /**
     * 待写入的年级
     */
    private $openGrade;
    /**
     * 钉钉企业管理员
     */
    private $operator;
    /**
     * 学段id
     */
    private $superId;

    public function setOpenGrade($openGrade)
    {
        $this->openGrade = $openGrade;
        $this->apiParas['open_grade'] = $openGrade;
    }

    public function getOpenGrade()
    {
        return $this->openGrade;
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

    public function setSuperId($superId)
    {
        $this->superId = $superId;
        $this->apiParas['super_id'] = $superId;
    }

    public function getSuperId()
    {
        return $this->superId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.grade.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
        RequestCheckUtil::checkNotNull($this->superId, 'superId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
