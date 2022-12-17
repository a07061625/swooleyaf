<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.isopensmartreport request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.20
 */
class IsOpenSmartReportRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.isopensmartreport';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
