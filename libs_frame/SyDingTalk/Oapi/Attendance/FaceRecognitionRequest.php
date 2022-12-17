<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.face.recognition request
 *
 * @author auto create
 *
 * @since 1.0, 2019.11.19
 */
class FaceRecognitionRequest extends BaseRequest
{
    /**
     * 钉钉mediaId
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
        return 'dingtalk.oapi.attendance.face.recognition';
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
