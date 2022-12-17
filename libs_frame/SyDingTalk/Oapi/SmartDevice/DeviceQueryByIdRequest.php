<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.device.querybyid request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.19
 */
class DeviceQueryByIdRequest extends BaseRequest
{
    /**
     * 设备查询对象
     */
    private $deviceQueryVo;

    public function setDeviceQueryVo($deviceQueryVo)
    {
        $this->deviceQueryVo = $deviceQueryVo;
        $this->apiParas['device_query_vo'] = $deviceQueryVo;
    }

    public function getDeviceQueryVo()
    {
        return $this->deviceQueryVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.device.querybyid';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
