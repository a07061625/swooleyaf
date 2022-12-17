<?php

namespace SyDingTalk\Oapi\Im;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.im.chat.scencegroup.file.downloadurl.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.01
 */
class ChatScenceGroupFileDownloadUrlGetRequest extends BaseRequest
{
    /**
     * downloadCode 会包含在如聊天消息推送等链路中提供给业务方
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
        return 'dingtalk.oapi.im.chat.scencegroup.file.downloadurl.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->downloadCode, 'downloadCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
