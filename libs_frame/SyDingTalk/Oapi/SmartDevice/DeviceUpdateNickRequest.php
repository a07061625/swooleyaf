<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.device.updatenick request
 *
 * @author auto create
 *
 * @since 1.0, 2020.02.07
 */
class DeviceUpdateNickRequest extends BaseRequest
{
    /**
     * 昵称修改参数
     */
    private $deviceNickModifyVo;

    public function setDeviceNickModifyVo($deviceNickModifyVo)
    {
        $this->deviceNickModifyVo = $deviceNickModifyVo;
        $this->apiParas['device_nick_modify_vo'] = $deviceNickModifyVo;
    }

    public function getDeviceNickModifyVo()
    {
        return $this->deviceNickModifyVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.device.updatenick';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
