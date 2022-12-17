<?php

namespace SyDingTalk\Oapi\Robot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.robot.message.orggrouptask.query request
 *
 * @author auto create
 *
 * @since 1.0, 2022.02.08
 */
class MessageOrgGroupTaskQueryRequest extends BaseRequest
{
    /**
     * 申请到的企业机器人唯一标识符
     */
    private $chatbotId;
    /**
     * 分页游标
     */
    private $cursor;
    /**
     * 开放的群ID
     */
    private $openConversationId;
    /**
     * 每页请求数量
     */
    private $pageSize;
    /**
     * 用于查询发送进度的唯一标识
     */
    private $processQueryKey;
    /**
     * 机器人webhook中的access_token参数，与chatbot_id+open_conversation_id 只需要填1种
     */
    private $token;

    public function setChatbotId($chatbotId)
    {
        $this->chatbotId = $chatbotId;
        $this->apiParas['chatbot_id'] = $chatbotId;
    }

    public function getChatbotId()
    {
        return $this->chatbotId;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setPageSize($pageSize)
    {
        $this->pageSize = $pageSize;
        $this->apiParas['page_size'] = $pageSize;
    }

    public function getPageSize()
    {
        return $this->pageSize;
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
        return 'dingtalk.oapi.robot.message.orggrouptask.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->processQueryKey, 'processQueryKey');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
