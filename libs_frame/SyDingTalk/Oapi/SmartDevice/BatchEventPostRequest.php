<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.batchevent.post request
 *
 * @author auto create
 *
 * @since 1.0, 2020.11.25
 */
class BatchEventPostRequest extends BaseRequest
{
    /**
     * 自动创建
     */
    private $deviceEventVos;

    public function setDeviceEventVos($deviceEventVos)
    {
        $this->deviceEventVos = $deviceEventVos;
        $this->apiParas['device_event_vos'] = $deviceEventVos;
    }

    public function getDeviceEventVos()
    {
        return $this->deviceEventVos;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.batchevent.post';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
