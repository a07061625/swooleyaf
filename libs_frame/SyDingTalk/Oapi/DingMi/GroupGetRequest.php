<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingmi.group.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.24
 */
class GroupGetRequest extends BaseRequest
{
    /**
     * 会话ID
     */
    private $conversationId;
    /**
     * ?期(YYYYMMDD格式)
     */
    private $date;

    public function setConversationId($conversationId)
    {
        $this->conversationId = $conversationId;
        $this->apiParas['conversation_id'] = $conversationId;
    }

    public function getConversationId()
    {
        return $this->conversationId;
    }

    public function setDate($date)
    {
        $this->date = $date;
        $this->apiParas['date'] = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingmi.group.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->conversationId, 'conversationId');
        RequestCheckUtil::checkNotNull($this->date, 'date');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
