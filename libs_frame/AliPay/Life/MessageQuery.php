<?php
/**
 * 生活号查询已发送消息接口
 * User: 姜伟
 * Date: 2018/11/1 0001
 * Time: 14:59
 */
namespace AliPay\Life;

use AliPay\AliPayBase;
use SyConstant\ErrorCode;
use SyException\AliPay\AliPayLifeException;

class MessageQuery extends AliPayBase
{
    /**
     * 消息id列表
     * @var array
     */
    private $message_ids = [];

    public function __construct(string $appId)
    {
        parent::__construct($appId);
        $this->setMethod('alipay.open.public.message.query');
    }

    private function __clone()
    {
    }

    /**
     * @param string $messageId
     * @throws \SyException\AliPay\AliPayLifeException
     */
    public function addMessageId(string $messageId)
    {
        if (!isset($this->message_ids[$messageId])) {
            if (count($this->message_ids) >= 20) {
                throw new AliPayLifeException('消息ID列表超过限制', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
            }

            $length = strlen($messageId);
            if (($length == 0) || ($length > 64)) {
                throw new AliPayLifeException('消息ID不合法', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
            }

            $this->message_ids[$messageId] = 1;
        }
    }

    public function getDetail() : array
    {
        if (empty($this->message_ids)) {
            throw new AliPayLifeException('消息ID列表不能为空', ErrorCode::ALIPAY_LIFE_PARAM_ERROR);
        }
        $this->biz_content['message_ids'] = array_keys($this->message_ids);

        return $this->getContent();
    }
}
