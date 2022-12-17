<?php

namespace SyDingTalk\Oapi\Crm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.crm.app.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.24
 */
class AppGetRequest extends BaseRequest
{
    /**
     * 业务表示,crm颁发或者申请
     */
    private $bizKey;

    public function setBizKey($bizKey)
    {
        $this->bizKey = $bizKey;
        $this->apiParas['biz_key'] = $bizKey;
    }

    public function getBizKey()
    {
        return $this->bizKey;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.crm.app.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizKey, 'bizKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
