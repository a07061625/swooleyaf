<?php
/**
 * 异步单发消息
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 11:41
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class MessageSendSingle extends AliPayBase
{
    /**
     * 用户ID
     * @var string
     */
    private $to_user_id = '';
    /**
     * 消息类型,text:文本消息 image-text:图文消息
     * @var string
     */
    private $msg_type = '';
    /**
     * 图文消息内容
     * @var array
     */
    private $articles = [];
    /**
     * 文本消息内容
     * @var array
     */
    private $text = [];
    /**
     * 聊天消息状态 0:非聊天消息,消息显示在生活号主页 1:聊天消息,消息显示在咨询反馈列表页
     * @var string
     */
    private $chat = '';
    /**
     * 事件类型
     * @var string
     */
    private $event_type = '';

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->biz_content['chat'] = '0';
        $this->setMethod('alipay.open.public.message.custom.send');
    }

    private function __clone()
    {
    }

    /**
     * @param string $userId
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setToUserId(string $userId)
    {
        if (ctype_digit($userId) && (strlen($userId) <= 32)) {
            $this->biz_content['to_user_id'] = $userId;
        } else {
            throw new AliPayLifeException('用户ID不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param string $msgType
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setMsgType(string $msgType)
    {
        if (in_array($msgType, ['text', 'image-text'], true)) {
            $this->biz_content['msg_type'] = $msgType;
        } else {
            throw new AliPayLifeException('消息类型不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $articles
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setArticles(array $articles)
    {
        if (!empty($articles)) {
            $this->biz_content['articles'] = $articles;
            unset($this->biz_content['text']);
        } else {
            throw new AliPayLifeException('图文消息内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $text
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setText(array $text)
    {
        if (!empty($text)) {
            $this->biz_content['text'] = $text;
            unset($this->biz_content['articles']);
        } else {
            throw new AliPayLifeException('文本消息内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param string $chat
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setChat(string $chat)
    {
        if (in_array($chat, ['0', '1'], true)) {
            $this->biz_content['chat'] = $chat;
        } else {
            throw new AliPayLifeException('聊天消息状态不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param string $eventType
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setEventType(string $eventType)
    {
        if (in_array($eventType, ['follow', 'click', 'enter_ppchat'], true)) {
            $this->biz_content['event_type'] = $eventType;
        } else {
            throw new AliPayLifeException('事件类型不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['to_user_id'])) {
            throw new AliPayLifeException('用户ID不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (!isset($this->biz_content['msg_type'])) {
            throw new AliPayLifeException('消息类型不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (($this->biz_content['msg_type'] == 'image-text') && !isset($this->biz_content['articles'])) {
            throw new AliPayLifeException('图文消息内容不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        } elseif (($this->biz_content['msg_type'] == 'text') && !isset($this->biz_content['text'])) {
            throw new AliPayLifeException('文本消息内容不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }

        return $this->getContent();
    }
}
