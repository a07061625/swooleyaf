<?php

namespace SyDingTalk\Oapi\Rhino;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.rhino.sales.order.custom.info.status.change request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.04
 */
class SalesOrderCustomInfoStatusChangeRequest extends BaseRequest
{
    /**
     * 请求提体
     */
    private $salesOrderCustomInfoChangeReq;

    public function setSalesOrderCustomInfoChangeReq($salesOrderCustomInfoChangeReq)
    {
        $this->salesOrderCustomInfoChangeReq = $salesOrderCustomInfoChangeReq;
        $this->apiParas['sales_order_custom_info_change_req'] = $salesOrderCustomInfoChangeReq;
    }

    public function getSalesOrderCustomInfoChangeReq()
    {
        return $this->salesOrderCustomInfoChangeReq;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.rhino.sales.order.custom.info.status.change';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
