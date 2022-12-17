<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.crm.objectdata.contact.update request
 *
 * @author auto create
 *
 * @since 1.0, 2021.01.07
 */
class ObjectDataContactUpdateRequest extends BaseRequest
{
    /**
     * 联系人数据
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
        return 'dingtalk.oapi.crm.objectdata.contact.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
