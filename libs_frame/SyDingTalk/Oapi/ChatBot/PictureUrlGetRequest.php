<?php

namespace SyDingTalk\Oapi\ChatBot;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.chatbot.pictureurl.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.25
 */
class PictureUrlGetRequest extends BaseRequest
{
    /**
     * 图片临时下载码
     */
    private $downloadCode;

    public function setDownloadCode($downloadCode)
    {
        $this->downloadCode = $downloadCode;
        $this->apiParas['download_code'] = $downloadCode;
    }

    public function getDownloadCode()
    {
        return $this->downloadCode;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.chatbot.pictureurl.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->downloadCode, 'downloadCode');
        RequestCheckUtil::checkMaxLength($this->downloadCode, 4000, 'downloadCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
