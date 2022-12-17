<?php

namespace SyDingTalk\Oapi\Service;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.service.get_unactive_corp request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class GetUnactiveCorpRequest extends BaseRequest
{
    /**
     * 套件下的微应用ID
     */
    private $appId;

    public function setAppId($appId)
    {
        $this->appId = $appId;
        $this->apiParas['app_id'] = $appId;
    }

    public function getAppId()
    {
        return $this->appId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.service.get_unactive_corp';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
