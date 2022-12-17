<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.videolive.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.10
 */
class DatavVideoLiveGetRequest extends BaseRequest
{
    /**
     * 请求参数对象
     */
    private $paramVideoLiveSummaryRequest;

    public function setParamVideoLiveSummaryRequest($paramVideoLiveSummaryRequest)
    {
        $this->paramVideoLiveSummaryRequest = $paramVideoLiveSummaryRequest;
        $this->apiParas['param_video_live_summary_request'] = $paramVideoLiveSummaryRequest;
    }

    public function getParamVideoLiveSummaryRequest()
    {
        return $this->paramVideoLiveSummaryRequest;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.datav.videolive.get';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
