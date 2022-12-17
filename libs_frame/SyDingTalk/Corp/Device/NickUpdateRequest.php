<?php

namespace SyDingTalk\Corp\Device;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.device.nick.update request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class NickUpdateRequest extends BaseRequest
{
    /**
     * 设备ID
     */
    private $deviceId;
    /**
     * 设备服务商ID
     */
    private $deviceServiceId;
    /**
     * 设备新昵称
     */
    private $newNick;

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

    public function setNewNick($newNick)
    {
        $this->newNick = $newNick;
        $this->apiParas['new_nick'] = $newNick;
    }

    public function getNewNick()
    {
        return $this->newNick;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.device.nick.update';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
        RequestCheckUtil::checkNotNull($this->deviceServiceId, 'deviceServiceId');
        RequestCheckUtil::checkNotNull($this->newNick, 'newNick');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
