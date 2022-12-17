<?php

namespace SyDingTalk\Oapi\Message;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.message.send_to_conversation request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.16
 */
class SendToConversationRequest extends BaseRequest
{
    /**
     * ActionCard消息
     */
    private $actionCard;
    /**
     * 群消息或者个人聊天会话Id，(通过JSAPI之pickConversation接口唤起联系人界面选择之后即可拿到会话ID，之后您可以使用获取到的cid调用此接口）
     */
    private $cid;
    /**
     * file消息
     */
    private $file;
    /**
     * image消息
     */
    private $image;
    /**
     * link消息
     */
    private $link;
    /**
     * markdown消息
     */
    private $markdown;
    /**
     * 消息内容
     */
    private $msg;
    /**
     * 消息类型
     */
    private $msgtype;
    /**
     * OA消息
     */
    private $oa;
    /**
     * 消息发送者员工ID
     */
    private $sender;
    /**
     * text消息
     */
    private $text;
    /**
     * voice消息
     */
    private $voice;

    public function setActionCard($actionCard)
    {
        $this->actionCard = $actionCard;
        $this->apiParas['action_card'] = $actionCard;
    }

    public function getActionCard()
    {
        return $this->actionCard;
    }

    public function setCid($cid)
    {
        $this->cid = $cid;
        $this->apiParas['cid'] = $cid;
    }

    public function getCid()
    {
        return $this->cid;
    }

    public function setFile($file)
    {
        $this->file = $file;
        $this->apiParas['file'] = $file;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setImage($image)
    {
        $this->image = $image;
        $this->apiParas['image'] = $image;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setLink($link)
    {
        $this->link = $link;
        $this->apiParas['link'] = $link;
    }

    public function getLink()
    {
        return $this->link;
    }

    public function setMarkdown($markdown)
    {
        $this->markdown = $markdown;
        $this->apiParas['markdown'] = $markdown;
    }

    public function getMarkdown()
    {
        return $this->markdown;
    }

    public function setMsg($msg)
    {
        $this->msg = $msg;
        $this->apiParas['msg'] = $msg;
    }

    public function getMsg()
    {
        return $this->msg;
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

    public function setOa($oa)
    {
        $this->oa = $oa;
        $this->apiParas['oa'] = $oa;
    }

    public function getOa()
    {
        return $this->oa;
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

    public function setText($text)
    {
        $this->text = $text;
        $this->apiParas['text'] = $text;
    }

    public function getText()
    {
        return $this->text;
    }

    public function setVoice($voice)
    {
        $this->voice = $voice;
        $this->apiParas['voice'] = $voice;
    }

    public function getVoice()
    {
        return $this->voice;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.message.send_to_conversation';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
