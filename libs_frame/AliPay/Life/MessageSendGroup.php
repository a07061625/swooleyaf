<?php
/**
 * 分组消息发送接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 14:39
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class MessageSendGroup extends AliPayBase
{
    /**
     * 分组ID
     * @var string
     */
    private $group_id = '';
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
     * 图片消息内容
     * @var array
     */
    private $image = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.message.group.send');
    }

    private function __clone()
    {
    }

    /**
     * @param string $groupId
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setGroupId(string $groupId)
    {
        if (ctype_digit($groupId) && (strlen($groupId) <= 10)) {
            $this->biz_content['group_id'] = $groupId;
        } else {
            throw new AliPayLifeException('分组ID不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param string $msgType
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setMsgType(string $msgType)
    {
        if (in_array($msgType, ['text', 'image', 'image-text'], true)) {
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
            unset($this->biz_content['text'], $this->biz_content['image']);
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
            unset($this->biz_content['articles'], $this->biz_content['image']);
        } else {
            throw new AliPayLifeException('文本消息内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    /**
     * @param array $image
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function setImage(array $image)
    {
        if (!empty($image)) {
            $this->biz_content['image'] = $image;
            unset($this->biz_content['articles'], $this->biz_content['text']);
        } else {
            throw new AliPayLifeException('图片消息内容不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
    }

    public function getDetail() : array
    {
        if (!isset($this->biz_content['group_id'])) {
            throw new AliPayLifeException('分组ID不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        if (!isset($this->biz_content['msg_type'])) {
            throw new AliPayLifeException('消息类型不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        switch ($this->biz_content['msg_type']) {
            case 'image-text':
                if (!isset($this->biz_content['articles'])) {
                    throw new AliPayLifeException('图文消息内容不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
                }
                break;
            case 'text':
                if (!isset($this->biz_content['text'])) {
                    throw new AliPayLifeException('文本消息内容不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
                }
                break;
            case 'image':
                if (!isset($this->biz_content['image'])) {
                    throw new AliPayLifeException('图片消息内容不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
                }
                break;
        }

        return $this->getContent();
    }
}
