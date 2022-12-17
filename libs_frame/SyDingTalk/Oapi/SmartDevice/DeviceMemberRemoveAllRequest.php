<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.devicemember.removeall request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.08
 */
class DeviceMemberRemoveAllRequest extends BaseRequest
{
    /**
     * 设备id
     */
    private $deviceId;

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->apiParas['device_id'] = $deviceId;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.devicemember.removeall';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
