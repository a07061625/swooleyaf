<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.humanres.productionteam.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.06
 */
class HumanResProductionTeamQueryRequest extends BaseRequest
{
    /**
     * 查询生产组入参
     */
    private $queryProductionTeamParam;

    public function setQueryProductionTeamParam($queryProductionTeamParam)
    {
        $this->queryProductionTeamParam = $queryProductionTeamParam;
        $this->apiParas['query_production_team_param'] = $queryProductionTeamParam;
    }

    public function getQueryProductionTeamParam()
    {
        return $this->queryProductionTeamParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.humanres.productionteam.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
