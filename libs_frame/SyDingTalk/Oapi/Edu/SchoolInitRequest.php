<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.school.init request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.31
 */
class SchoolInitRequest extends BaseRequest
{
    /**
     * 校区
     */
    private $campus;
    /**
     * 钉钉企业通讯录管理员
     */
    private $operator;

    public function setCampus($campus)
    {
        $this->campus = $campus;
        $this->apiParas['campus'] = $campus;
    }

    public function getCampus()
    {
        return $this->campus;
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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.school.init';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->operator, 'operator');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
