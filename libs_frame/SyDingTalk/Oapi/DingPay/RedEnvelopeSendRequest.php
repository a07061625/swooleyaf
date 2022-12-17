<?php

namespace SyDingTalk\Oapi\DingPay;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.dingpay.redenvelope.send request
 *
 * @author auto create
 *
 * @since 1.0, 2021.05.08
 */
class RedEnvelopeSendRequest extends BaseRequest
{
    /**
     * 群会话ID
     */
    private $chatId;
    /**
     * 企业业务订单号（每个订单号必须唯一。取值范围：0~9，a~z，A~Z），接口根据企业订单号支持幂等，组成参考：corp_id+yyyymmdd+10位一天内不能重复的数字
     */
    private $corpBizNo;
    /**
     * 额外参数
     */
    private $extParams;
    /**
     * 红包祝福语
     */
    private $greetings;
    /**
     * 群会话ID
     */
    private $openConversationId;
    /**
     * 支付方式，WITHHOLD：代扣模式，目前只支持该方式
     */
    private $payMethod;
    /**
     * 签名方式咨询技术支持
     */
    private $paySign;
    /**
     * 接收人ID
     */
    private $receiverId;
    /**
     * 发送人ID
     */
    private $senderId;
    /**
     * 红包主题ID
     */
    private $themeId;
    /**
     * 红包金额
     */
    private $totalAmount;
    /**
     * 红包类型，目前支持：SINGLE_QUOTA，个人单聊红包
     */
    private $type;

    public function setChatId($chatId)
    {
        $this->chatId = $chatId;
        $this->apiParas['chat_id'] = $chatId;
    }

    public function getChatId()
    {
        return $this->chatId;
    }

    public function setCorpBizNo($corpBizNo)
    {
        $this->corpBizNo = $corpBizNo;
        $this->apiParas['corp_biz_no'] = $corpBizNo;
    }

    public function getCorpBizNo()
    {
        return $this->corpBizNo;
    }

    public function setExtParams($extParams)
    {
        $this->extParams = $extParams;
        $this->apiParas['ext_params'] = $extParams;
    }

    public function getExtParams()
    {
        return $this->extParams;
    }

    public function setGreetings($greetings)
    {
        $this->greetings = $greetings;
        $this->apiParas['greetings'] = $greetings;
    }

    public function getGreetings()
    {
        return $this->greetings;
    }

    public function setOpenConversationId($openConversationId)
    {
        $this->openConversationId = $openConversationId;
        $this->apiParas['open_conversation_id'] = $openConversationId;
    }

    public function getOpenConversationId()
    {
        return $this->openConversationId;
    }

    public function setPayMethod($payMethod)
    {
        $this->payMethod = $payMethod;
        $this->apiParas['pay_method'] = $payMethod;
    }

    public function getPayMethod()
    {
        return $this->payMethod;
    }

    public function setPaySign($paySign)
    {
        $this->paySign = $paySign;
        $this->apiParas['pay_sign'] = $paySign;
    }

    public function getPaySign()
    {
        return $this->paySign;
    }

    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
        $this->apiParas['receiver_id'] = $receiverId;
    }

    public function getReceiverId()
    {
        return $this->receiverId;
    }

    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
        $this->apiParas['sender_id'] = $senderId;
    }

    public function getSenderId()
    {
        return $this->senderId;
    }

    public function setThemeId($themeId)
    {
        $this->themeId = $themeId;
        $this->apiParas['theme_id'] = $themeId;
    }

    public function getThemeId()
    {
        return $this->themeId;
    }

    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
        $this->apiParas['total_amount'] = $totalAmount;
    }

    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.dingpay.redenvelope.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->corpBizNo, 'corpBizNo');
        RequestCheckUtil::checkNotNull($this->payMethod, 'payMethod');
        RequestCheckUtil::checkNotNull($this->paySign, 'paySign');
        RequestCheckUtil::checkNotNull($this->receiverId, 'receiverId');
        RequestCheckUtil::checkNotNull($this->totalAmount, 'totalAmount');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
