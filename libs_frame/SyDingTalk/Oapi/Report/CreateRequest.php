<?php

namespace SyDingTalk\Oapi\Report;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.report.create request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.14
 */
class CreateRequest extends BaseRequest
{
    /**
     * 创建日志的参数对象
     */
    private $createReportParam;

    public function setCreateReportParam($createReportParam)
    {
        $this->createReportParam = $createReportParam;
        $this->apiParas['create_report_param'] = $createReportParam;
    }

    public function getCreateReportParam()
    {
        return $this->createReportParam;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.report.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
