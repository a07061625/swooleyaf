<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.external.bind request
 *
 * @author auto create
 *
 * @since 1.0, 2019.12.25
 */
class ExternalBindRequest extends BaseRequest
{
    /**
     * 设备请求信息
     */
    private $deviceBindReqVo;

    public function setDeviceBindReqVo($deviceBindReqVo)
    {
        $this->deviceBindReqVo = $deviceBindReqVo;
        $this->apiParas['device_bind_req_vo'] = $deviceBindReqVo;
    }

    public function getDeviceBindReqVo()
    {
        return $this->deviceBindReqVo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.external.bind';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
