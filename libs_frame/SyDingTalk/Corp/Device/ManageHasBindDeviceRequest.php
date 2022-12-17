<?php

namespace SyDingTalk\Corp\Device;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.device.manage.hasbinddevice request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class ManageHasBindDeviceRequest extends BaseRequest
{
    /**
     * 设备产品类型 产品编码：M1：9 C1：14 M2：15 D1：24
     */
    private $deviceServiceId;

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
        return 'dingtalk.corp.device.manage.hasbinddevice';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deviceServiceId, 'deviceServiceId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
