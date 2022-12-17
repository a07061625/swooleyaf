<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.userid.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.20
 */
class UseridGetRequest extends BaseRequest
{
    /**
     * 手机列表，最大不超过50个
     */
    private $mobiles;
    /**
     * 操作者id
     */
    private $operator;

    public function setMobiles($mobiles)
    {
        $this->mobiles = $mobiles;
        $this->apiParas['mobiles'] = $mobiles;
    }

    public function getMobiles()
    {
        return $this->mobiles;
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
        return 'dingtalk.oapi.edu.userid.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mobiles, 'mobiles');
        RequestCheckUtil::checkMaxListSize($this->mobiles, 999, 'mobiles');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
