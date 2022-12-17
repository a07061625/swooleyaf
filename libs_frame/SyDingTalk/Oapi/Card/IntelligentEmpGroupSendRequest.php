<?php

namespace SyDingTalk\Oapi\Card;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.card.intelligent.empgroup.send request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.17
 */
class IntelligentEmpGroupSendRequest extends BaseRequest
{
    /**
     * 模版卡片注册的key
     */
    private $msgKey;
    /**
     * 卡片中需要填充的参数
     */
    private $paramJson;
    /**
     * 卡片接收成员列表，不填写为全部接收
     */
    private $receiverList;
    /**
     * 卡片消息去重复，长度不能大于64
     */
    private $uuid;

    public function setMsgKey($msgKey)
    {
        $this->msgKey = $msgKey;
        $this->apiParas['msg_key'] = $msgKey;
    }

    public function getMsgKey()
    {
        return $this->msgKey;
    }

    public function setParamJson($paramJson)
    {
        $this->paramJson = $paramJson;
        $this->apiParas['param_json'] = $paramJson;
    }

    public function getParamJson()
    {
        return $this->paramJson;
    }

    public function setReceiverList($receiverList)
    {
        $this->receiverList = $receiverList;
        $this->apiParas['receiver_list'] = $receiverList;
    }

    public function getReceiverList()
    {
        return $this->receiverList;
    }

    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
        $this->apiParas['uuid'] = $uuid;
    }

    public function getUuid()
    {
        return $this->uuid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.card.intelligent.empgroup.send';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->msgKey, 'msgKey');
        RequestCheckUtil::checkMaxListSize($this->receiverList, 999, 'receiverList');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
