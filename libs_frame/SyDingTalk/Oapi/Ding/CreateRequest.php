<?php

namespace SyDingTalk\Oapi\Ding;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ding.create request
 *
 * @author auto create
 *
 * @since 1.0, 2019.11.18
 */
class CreateRequest extends BaseRequest
{
    /**
     * 附件内容
     */
    private $attachment;
    /**
     * 发送者工号
     */
    private $creatorUserid;
    /**
     * 接收者工号列表
     */
    private $receiverUserids;
    /**
     * 发送时间(单位:毫秒)
     */
    private $remindTime;
    /**
     * 提醒类型:1-应用内;2-短信
     */
    private $remindType;
    /**
     * 通知内容
     */
    private $textContent;

    public function setAttachment($attachment)
    {
        $this->attachment = $attachment;
        $this->apiParas['attachment'] = $attachment;
    }

    public function getAttachment()
    {
        return $this->attachment;
    }

    public function setCreatorUserid($creatorUserid)
    {
        $this->creatorUserid = $creatorUserid;
        $this->apiParas['creator_userid'] = $creatorUserid;
    }

    public function getCreatorUserid()
    {
        return $this->creatorUserid;
    }

    public function setReceiverUserids($receiverUserids)
    {
        $this->receiverUserids = $receiverUserids;
        $this->apiParas['receiver_userids'] = $receiverUserids;
    }

    public function getReceiverUserids()
    {
        return $this->receiverUserids;
    }

    public function setRemindTime($remindTime)
    {
        $this->remindTime = $remindTime;
        $this->apiParas['remind_time'] = $remindTime;
    }

    public function getRemindTime()
    {
        return $this->remindTime;
    }

    public function setRemindType($remindType)
    {
        $this->remindType = $remindType;
        $this->apiParas['remind_type'] = $remindType;
    }

    public function getRemindType()
    {
        return $this->remindType;
    }

    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;
        $this->apiParas['text_content'] = $textContent;
    }

    public function getTextContent()
    {
        return $this->textContent;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ding.create';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->creatorUserid, 'creatorUserid');
        RequestCheckUtil::checkNotNull($this->receiverUserids, 'receiverUserids');
        RequestCheckUtil::checkMaxListSize($this->receiverUserids, 20, 'receiverUserids');
        RequestCheckUtil::checkNotNull($this->remindTime, 'remindTime');
        RequestCheckUtil::checkNotNull($this->remindType, 'remindType');
        RequestCheckUtil::checkNotNull($this->textContent, 'textContent');
        RequestCheckUtil::checkMaxLength($this->textContent, 5000, 'textContent');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
