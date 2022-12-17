<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.videoconf.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.26
 */
class DatavVideoConfGetRequest extends BaseRequest
{
    /**
     * 请求对象类型
     */
    private $paramMcsSummaryRequest;

    public function setParamMcsSummaryRequest($paramMcsSummaryRequest)
    {
        $this->paramMcsSummaryRequest = $paramMcsSummaryRequest;
        $this->apiParas['param_mcs_summary_request'] = $paramMcsSummaryRequest;
    }

    public function getParamMcsSummaryRequest()
    {
        return $this->paramMcsSummaryRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.datav.videoconf.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
