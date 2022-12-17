<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.class.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.31
 */
class ClassCreateRequest extends BaseRequest
{
    /**
     * 班级
     */
    private $openClass;
    /**
     * 钉钉企业管理员
     */
    private $operator;
    /**
     * 年级id
     */
    private $superId;

    public function setOpenClass($openClass)
    {
        $this->openClass = $openClass;
        $this->apiParas['open_class'] = $openClass;
    }

    public function getOpenClass()
    {
        return $this->openClass;
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
        return 'dingtalk.oapi.edu.class.create';
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
