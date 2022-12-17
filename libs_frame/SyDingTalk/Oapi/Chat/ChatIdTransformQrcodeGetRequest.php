<?php

namespace SyDingTalk\Oapi\Chat;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chat.chatid.transformqrcode.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.12
 */
class ChatIdTransformQrcodeGetRequest extends BaseRequest
{
    /**
     * 群二维码的url
     */
    private $groupUrl;

    public function setGroupUrl($groupUrl)
    {
        $this->groupUrl = $groupUrl;
        $this->apiParas['group_url'] = $groupUrl;
    }

    public function getGroupUrl()
    {
        return $this->groupUrl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chat.chatid.transformqrcode.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->groupUrl, 'groupUrl');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
