<?php

namespace SyDingTalk\Oapi\Asr;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.asr.voice.translate request
 *
 * @author auto create
 *
 * @since 1.0, 2020.09.11
 */
class VoiceTranslateRequest extends BaseRequest
{
    /**
     * media_id，获取方式见https://ding-doc.dingtalk.com/doc#/serverapi2/bcmg0i
     */
    private $mediaId;

    public function setMediaId($mediaId)
    {
        $this->mediaId = $mediaId;
        $this->apiParas['media_id'] = $mediaId;
    }

    public function getMediaId()
    {
        return $this->mediaId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.asr.voice.translate';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->mediaId, 'mediaId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
