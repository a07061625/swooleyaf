<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.robot.message.getpushid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.15
 */
class MessageGetPushIdRequest extends BaseRequest
{
    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.getpushid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
