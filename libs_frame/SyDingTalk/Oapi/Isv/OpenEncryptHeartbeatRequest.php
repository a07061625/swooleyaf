<?php

namespace SyDingTalk\Oapi\Isv;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.isv.openencrypt.heartbeat request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.09
 */
class OpenEncryptHeartbeatRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topKmsHeartbeat;

    public function setTopKmsHeartbeat($topKmsHeartbeat)
    {
        $this->topKmsHeartbeat = $topKmsHeartbeat;
        $this->apiParas['top_kms_heartbeat'] = $topKmsHeartbeat;
    }

    public function getTopKmsHeartbeat()
    {
        return $this->topKmsHeartbeat;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.isv.openencrypt.heartbeat';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
