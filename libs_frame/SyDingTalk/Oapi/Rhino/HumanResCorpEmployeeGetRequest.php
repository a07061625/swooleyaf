<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.humanres.corpemployee.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.06
 */
class HumanResCorpEmployeeGetRequest extends BaseRequest
{
    /**
     * 查询员工入参
     */
    private $queryCorpEmployeeParam;

    public function setQueryCorpEmployeeParam($queryCorpEmployeeParam)
    {
        $this->queryCorpEmployeeParam = $queryCorpEmployeeParam;
        $this->apiParas['query_corp_employee_param'] = $queryCorpEmployeeParam;
    }

    public function getQueryCorpEmployeeParam()
    {
        return $this->queryCorpEmployeeParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.humanres.corpemployee.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
