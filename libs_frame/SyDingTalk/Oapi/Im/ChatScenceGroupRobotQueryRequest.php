<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.robot.query request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.26
 */
class ChatScenceGroupRobotQueryRequest extends BaseRequest
{
    /**
     * 群标识
     */
    private $openConversationId;
    /**
     * 群模板关联的群机器人robotCode
     */
    private $robotCode;

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setRobotCode($robotCode)
    {
        $this->robotCode = $robotCode;
        $this->apiParas['robot_code'] = $robotCode;
    }

    public function getRobotCode()
    {
        return $this->robotCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.im.chat.scencegroup.robot.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->openConversationId, 'openConversationId');
        RequestCheckUtil::checkNotNull($this->robotCode, 'robotCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
