<?php

namespace SyDingTalk\Oapi\Mpdev;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.mpdev.accesskey.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.15
 */
class AccessKeyGetRequest extends BaseRequest
{
    /**
     * 小程序ID
     */
    private $miniappId;

    public function setMiniappId($miniappId)
    {
        $this->miniappId = $miniappId;
        $this->apiParas['miniapp_id'] = $miniappId;
    }

    public function getMiniappId()
    {
        return $this->miniappId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.mpdev.accesskey.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->miniappId, 'miniappId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
