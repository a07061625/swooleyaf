<?php

namespace SyDingTalk\Oapi\Collection;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.collection.instance.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.01
 */
class InstanceGetRequest extends BaseRequest
{
    /**
     * 0表示通用填表，1表示教育版填表
     */
    private $bizType;
    /**
     * 实例id
     */
    private $formInstanceId;

    public function setBizType($bizType)
    {
        $this->bizType = $bizType;
        $this->apiParas['biz_type'] = $bizType;
    }

    public function getBizType()
    {
        return $this->bizType;
    }

    public function setFormInstanceId($formInstanceId)
    {
        $this->formInstanceId = $formInstanceId;
        $this->apiParas['formInstance_id'] = $formInstanceId;
    }

    public function getFormInstanceId()
    {
        return $this->formInstanceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.collection.instance.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->formInstanceId, 'formInstanceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
