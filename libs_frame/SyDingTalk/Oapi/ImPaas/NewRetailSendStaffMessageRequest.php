<?php

namespace SyDingTalk\Oapi\ImPaas;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.impaas.newretail.sendstaffmessage request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class NewRetailSendStaffMessageRequest extends BaseRequest
{
    /**
     * 消息体
     */
    private $content;
    /**
     * 0系统消息
     */
    private $msgType;
    /**
     * 系统账号
     */
    private $sender;
    /**
     * 用账号列表
     */
    private $useridList;

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setMsgType($msgType)
    {
        $this->msgType = $msgType;
        $this->apiParas['msg_type'] = $msgType;
    }

    public function getMsgType()
    {
        return $this->msgType;
    }

    public function setSender($sender)
    {
        $this->sender = $sender;
        $this->apiParas['sender'] = $sender;
    }

    public function getSender()
    {
        return $this->sender;
    }

    public function setUseridList($useridList)
    {
        $this->useridList = $useridList;
        $this->apiParas['userid_list'] = $useridList;
    }

    public function getUseridList()
    {
        return $this->useridList;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.impaas.newretail.sendstaffmessage';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkMaxListSize($this->useridList, 100, 'useridList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
