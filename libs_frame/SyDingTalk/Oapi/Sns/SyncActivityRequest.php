<?php

namespace SyDingTalk\Oapi\Sns;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.sns.sync_activity request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class SyncActivityRequest extends BaseRequest
{
    /**
     * 11
     */
    private $unionId;

    public function setUnionId($unionId)
    {
        $this->unionId = $unionId;
        $this->apiParas['unionId'] = $unionId;
    }

    public function getUnionId()
    {
        return $this->unionId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.sns.sync_activity';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
