<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.customer.create request
 *
 * @author auto create
 *
 * @since 1.0, 2021.09.10
 */
class ObjectDataCustomerCreateRequest extends BaseRequest
{
    /**
     * 客户数据
     */
    private $instance;

    public function setInstance($instance)
    {
        $this->instance = $instance;
        $this->apiParas['instance'] = $instance;
    }

    public function getInstance()
    {
        return $this->instance;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectdata.customer.create';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
