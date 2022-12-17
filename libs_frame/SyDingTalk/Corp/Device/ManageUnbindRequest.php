<?php

namespace SyDingTalk\Corp\Device;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.device.manage.unbind request
 *
 * @author auto create
 *
 * @since 1.0, 2018.07.25
 */
class ManageUnbindRequest extends BaseRequest
{
    /**
     * 设备ID
     */
    private $deviceId;
    /**
     * 设备服务商ID
     */
    private $deviceServiceId;

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->apiParas['device_id'] = $deviceId;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function setDeviceServiceId($deviceServiceId)
    {
        $this->deviceServiceId = $deviceServiceId;
        $this->apiParas['device_service_id'] = $deviceServiceId;
    }

    public function getDeviceServiceId()
    {
        return $this->deviceServiceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.device.manage.unbind';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
        RequestCheckUtil::checkNotNull($this->deviceServiceId, 'deviceServiceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
