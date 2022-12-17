<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.theme.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.10.31
 */
class ThemeUpdateRequest extends BaseRequest
{
    /**
     * 会话id
     */
    private $chatid;
    /**
     * 图片id
     */
    private $mediaid;

    public function setChatid($chatid)
    {
        $this->chatid = $chatid;
        $this->apiParas['chatid'] = $chatid;
    }

    public function getChatid()
    {
        return $this->chatid;
    }

    public function setMediaid($mediaid)
    {
        $this->mediaid = $mediaid;
        $this->apiParas['mediaid'] = $mediaid;
    }

    public function getMediaid()
    {
        return $this->mediaid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.theme.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->chatid, 'chatid');
        RequestCheckUtil::checkNotNull($this->mediaid, 'mediaid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
