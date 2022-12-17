<?php

namespace SyDingTalk\Oapi\Media;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.media.upload request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class UploadRequest extends BaseRequest
{
    /**
     * form-data中媒体文件标识，有filename、filelength、content-type等信息
     */
    private $media;
    /**
     * 媒体文件类型，分别有图片（image）、语音（voice）、普通文件(file)
     */
    private $type;

    public function setMedia($media)
    {
        $this->media = $media;
        $this->apiParas['media'] = $media;
    }

    public function getMedia()
    {
        return $this->media;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.media.upload';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->media, 'media');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
