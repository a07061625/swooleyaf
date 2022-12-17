<?php

namespace SyDingTalk\Oapi\DingMi;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.dingmi.common.robot.ask request
 *
 * @author auto create
 *
 * @since 1.0, 2021.02.03
 */
class CommonRobotAskRequest extends BaseRequest
{
    /**
     * 问题内容
     */
    private $question;
    /**
     * 机器人唯一标识
     */
    private $robotAppKey;
    /**
     * 会话id为了跟踪某一次会话
     */
    private $sessionUuid;

    public function setQuestion($question)
    {
        $this->question = $question;
        $this->apiParas['question'] = $question;
    }

    public function getQuestion()
    {
        return $this->question;
    }

    public function setRobotAppKey($robotAppKey)
    {
        $this->robotAppKey = $robotAppKey;
        $this->apiParas['robot_app_key'] = $robotAppKey;
    }

    public function getRobotAppKey()
    {
        return $this->robotAppKey;
    }

    public function setSessionUuid($sessionUuid)
    {
        $this->sessionUuid = $sessionUuid;
        $this->apiParas['session_uuid'] = $sessionUuid;
    }

    public function getSessionUuid()
    {
        return $this->sessionUuid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingmi.common.robot.ask';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
