<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.device.unbind request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.07
 */
class DeviceUnbindRequest extends BaseRequest
{
    /**
     * 解绑参数
     */
    private $deviceUnbindVo;

    public function setDeviceUnbindVo($deviceUnbindVo)
    {
        $this->deviceUnbindVo = $deviceUnbindVo;
        $this->apiParas['device_unbind_vo'] = $deviceUnbindVo;
    }

    public function getDeviceUnbindVo()
    {
        return $this->deviceUnbindVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.device.unbind';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
