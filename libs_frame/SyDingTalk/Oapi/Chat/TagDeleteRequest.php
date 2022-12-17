<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.tag.delete request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.31
 */
class TagDeleteRequest extends BaseRequest
{
    /**
     * 内部群的id
     */
    private $chatid;
    /**
     * 群标签的类型。1表示经销群；2表示销管群
     */
    private $groupTag;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setGroupTag($groupTag)
    {
        $this->groupTag = $groupTag;
        $this->apiParas['group_tag'] = $groupTag;
    }

    public function getGroupTag()
    {
        return $this->groupTag;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.tag.delete';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
        RequestCheckUtil::checkNotNull($this->groupTag, 'groupTag');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
