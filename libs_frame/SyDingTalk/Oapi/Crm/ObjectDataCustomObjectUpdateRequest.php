<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.customobject.update request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.12
 */
class ObjectDataCustomObjectUpdateRequest extends BaseRequest
{
    /**
     * 自定义对象数据
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
        return 'dingtalk.oapi.crm.objectdata.customobject.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
