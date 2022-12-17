<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.grouptask.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.03.03
 */
class MessageGroupTaskQueryRequest extends BaseRequest
{
    /**
     * 用于查询发送进度的唯一标识
     */
    private $processQueryKey;
    /**
     * 群机器人webhook中的token
     */
    private $token;

    public function setProcessQueryKey($processQueryKey)
    {
        $this->processQueryKey = $processQueryKey;
        $this->apiParas['process_query_key'] = $processQueryKey;
    }

    public function getProcessQueryKey()
    {
        return $this->processQueryKey;
    }

    public function setToken($token)
    {
        $this->token = $token;
        $this->apiParas['token'] = $token;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.grouptask.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processQueryKey, 'processQueryKey');
        RequestCheckUtil::checkNotNull($this->token, 'token');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
