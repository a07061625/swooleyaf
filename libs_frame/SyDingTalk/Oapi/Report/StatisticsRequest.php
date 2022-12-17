<?php

namespace SyDingTalk\Oapi\Report;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.report.statistics request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.19
 */
class StatisticsRequest extends BaseRequest
{
    /**
     * 日志id
     */
    private $reportId;

    public function setReportId($reportId)
    {
        $this->reportId = $reportId;
        $this->apiParas['report_id'] = $reportId;
    }

    public function getReportId()
    {
        return $this->reportId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.report.statistics';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->reportId, 'reportId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
