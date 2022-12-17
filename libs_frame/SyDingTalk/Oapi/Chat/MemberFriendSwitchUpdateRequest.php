<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.member.friendswitch.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.15
 */
class MemberFriendSwitchUpdateRequest extends BaseRequest
{
    /**
     * 会话Id
     */
    private $chatid;
    /**
     * true开启禁止开关，false关闭禁止开关
     */
    private $isProhibit;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setIsProhibit($isProhibit)
    {
        $this->isProhibit = $isProhibit;
        $this->apiParas['is_prohibit'] = $isProhibit;
    }

    public function getIsProhibit()
    {
        return $this->isProhibit;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.member.friendswitch.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
        RequestCheckUtil::checkNotNull($this->isProhibit, 'isProhibit');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
