<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.ototask.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.06
 */
class MessageOtoTaskQueryRequest extends BaseRequest
{
    /**
     * 申请到的企业机器人唯一标识符
     */
    private $chatbotId;
    /**
     * 用于查询发送进度的唯一标识
     */
    private $processQueryKey;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function setProcessQueryKey($processQueryKey)
    {
        $this->processQueryKey = $processQueryKey;
        $this->apiParas['process_query_key'] = $processQueryKey;
    }

    public function getProcessQueryKey()
    {
        return $this->processQueryKey;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.robot.message.ototask.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatbotId, 'chatbotId');
        RequestCheckUtil::checkNotNull($this->processQueryKey, 'processQueryKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
