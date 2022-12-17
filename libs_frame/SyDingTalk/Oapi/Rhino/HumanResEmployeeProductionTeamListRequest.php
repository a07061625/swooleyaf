<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.humanres.employee.productionteam.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.13
 */
class HumanResEmployeeProductionTeamListRequest extends BaseRequest
{
    /**
     * 查询参数
     */
    private $queryEmployeeProductionTeamParam;

    public function setQueryEmployeeProductionTeamParam($queryEmployeeProductionTeamParam)
    {
        $this->queryEmployeeProductionTeamParam = $queryEmployeeProductionTeamParam;
        $this->apiParas['query_employee_production_team_param'] = $queryEmployeeProductionTeamParam;
    }

    public function getQueryEmployeeProductionTeamParam()
    {
        return $this->queryEmployeeProductionTeamParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.humanres.employee.productionteam.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
