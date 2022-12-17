<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.event.post request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.25
 */
class EventPostRequest extends BaseRequest
{
    /**
     * 系统自动生成
     */
    private $deviceEventVo;

    public function setDeviceEventVo($deviceEventVo)
    {
        $this->deviceEventVo = $deviceEventVo;
        $this->apiParas['device_event_vo'] = $deviceEventVo;
    }

    public function getDeviceEventVo()
    {
        return $this->deviceEventVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.event.post';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
