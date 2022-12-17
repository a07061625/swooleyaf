<?php

namespace SyDingTalk\Oapi\DdPaas;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ddpaas.objectmeta.describe request
 *
 * @author auto create
 *
 * @since 1.0, 2020.06.28
 */
class ObjectMetaDescribeRequest extends BaseRequest
{
    /**
     * PaaS应用ID
     */
    private $appUuid;
    /**
     * 表单编号
     */
    private $formCode;

    public function setAppUuid($appUuid)
    {
        $this->appUuid = $appUuid;
        $this->apiParas['app_uuid'] = $appUuid;
    }

    public function getAppUuid()
    {
        return $this->appUuid;
    }

    public function setFormCode($formCode)
    {
        $this->formCode = $formCode;
        $this->apiParas['form_code'] = $formCode;
    }

    public function getFormCode()
    {
        return $this->formCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ddpaas.objectmeta.describe';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->appUuid, 'appUuid');
        RequestCheckUtil::checkNotNull($this->formCode, 'formCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
