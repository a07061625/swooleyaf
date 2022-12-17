<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.nick.batchupdate request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.01
 */
class NickBatchUpdateRequest extends BaseRequest
{
    /**
     * 会话id
     */
    private $chatid;
    /**
     * userId和nick的模型
     */
    private $userNickModel;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setUserNickModel($userNickModel)
    {
        $this->userNickModel = $userNickModel;
        $this->apiParas['user_nick_model'] = $userNickModel;
    }

    public function getUserNickModel()
    {
        return $this->userNickModel;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.nick.batchupdate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
