<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.ding.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.17
 */
class DatavDingGetRequest extends BaseRequest
{
    /**
     * 请求对象
     */
    private $dingUsageSummaryRequest;

    public function setDingUsageSummaryRequest($dingUsageSummaryRequest)
    {
        $this->dingUsageSummaryRequest = $dingUsageSummaryRequest;
        $this->apiParas['ding_usage_summary_request'] = $dingUsageSummaryRequest;
    }

    public function getDingUsageSummaryRequest()
    {
        return $this->dingUsageSummaryRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.datav.ding.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
