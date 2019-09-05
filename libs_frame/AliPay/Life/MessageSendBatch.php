<?php
/**
 * 群发消息
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 11:40
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class MessageSendBatch extends AliPayBase
{
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

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.message.total.send');
    }

    private function __clone()
    {
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

    public function getDetail() : array
    {
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
