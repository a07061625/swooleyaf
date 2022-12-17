<?php

namespace SyDingTalk\Oapi\KeFu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.kefu.sendmessage request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class SendMessageRequest extends BaseRequest
{
    /**
     * 消息体
     */
    private $content;
    /**
     * 消费者id
     */
    private $customerid;
    /**
     * 消息类型
     */
    private $msgtype;
    /**
     * 客服服务id
     */
    private $serviceid;
    /**
     * 消息token
     */
    private $token;
    /**
     * 客服id
     */
    private $userid;

    public function setContent($content)
    {
        $this->content = $content;
        $this->apiParas['content'] = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setCustomerid($customerid)
    {
        $this->customerid = $customerid;
        $this->apiParas['customerid'] = $customerid;
    }

    public function getCustomerid()
    {
        return $this->customerid;
    }

    public function setMsgtype($msgtype)
    {
        $this->msgtype = $msgtype;
        $this->apiParas['msgtype'] = $msgtype;
    }

    public function getMsgtype()
    {
        return $this->msgtype;
    }

    public function setServiceid($serviceid)
    {
        $this->serviceid = $serviceid;
        $this->apiParas['serviceid'] = $serviceid;
    }

    public function getServiceid()
    {
        return $this->serviceid;
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
        return 'dingtalk.oapi.kefu.sendmessage';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->content, 'content');
        RequestCheckUtil::checkNotNull($this->customerid, 'customerid');
        RequestCheckUtil::checkNotNull($this->msgtype, 'msgtype');
        RequestCheckUtil::checkNotNull($this->serviceid, 'serviceid');
        RequestCheckUtil::checkNotNull($this->token, 'token');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
