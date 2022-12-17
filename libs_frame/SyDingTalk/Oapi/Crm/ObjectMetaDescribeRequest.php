<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.objectmeta.describe request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.04
 */
class ObjectMetaDescribeRequest extends BaseRequest
{
    /**
     * 目标名称
     */
    private $name;

    public function setName($name)
    {
        $this->name = $name;
        $this->apiParas['name'] = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.objectmeta.describe';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->name, 'name');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
