<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.qr.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.26
 */
class QrQueryRequest extends BaseRequest
{
    /**
     * 二维码内容
     */
    private $qrContent;

    public function setQrContent($qrContent)
    {
        $this->qrContent = $qrContent;
        $this->apiParas['qr_content'] = $qrContent;
    }

    public function getQrContent()
    {
        return $this->qrContent;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.qr.query';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
