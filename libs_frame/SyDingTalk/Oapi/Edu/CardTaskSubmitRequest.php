<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.edu.card.task.submit request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.23
 */
class CardTaskSubmitRequest extends BaseRequest
{
    /**
     * 打卡类型,跳绳:jump
     */
    private $cardType;
    /**
     * 打卡内容
     */
    private $content;
    /**
     * 计量数量
     */
    private $meteringNumber;
    /**
     * 任务id
     */
    private $userCardTaskId;
    /**
     * 用户id
     */
    private $userid;

    public function setCardType($cardType)
    {
        $this->cardType = $cardType;
        $this->apiParas['card_type'] = $cardType;
    }

    public function getCardType()
    {
        return $this->cardType;
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setMeteringNumber($meteringNumber)
    {
        $this->meteringNumber = $meteringNumber;
        $this->apiParas['metering_number'] = $meteringNumber;
    }

    public function getMeteringNumber()
    {
        return $this->meteringNumber;
    }

    public function setUserCardTaskId($userCardTaskId)
    {
        $this->userCardTaskId = $userCardTaskId;
        $this->apiParas['user_card_task_id'] = $userCardTaskId;
    }

    public function getUserCardTaskId()
    {
        return $this->userCardTaskId;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.card.task.submit';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
