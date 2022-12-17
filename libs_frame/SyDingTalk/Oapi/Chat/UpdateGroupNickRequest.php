<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.updategroupnick request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UpdateGroupNickRequest extends BaseRequest
{
    /**
     * chatid
     */
    private $chatid;
    /**
     * 群昵称
     */
    private $groupNick;
    /**
     * 用户userid
     */
    private $userid;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setGroupNick($groupNick)
    {
        $this->groupNick = $groupNick;
        $this->apiParas['group_nick'] = $groupNick;
    }

    public function getGroupNick()
    {
        return $this->groupNick;
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
        return 'dingtalk.oapi.chat.updategroupnick';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
        RequestCheckUtil::checkNotNull($this->groupNick, 'groupNick');
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
