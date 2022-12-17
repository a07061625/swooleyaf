<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.facegroup.enable request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FaceGroupEnableRequest extends BaseRequest
{
    /**
     * 业务id
     */
    private $bizId;
    /**
     * 设备id列表
     */
    private $deviceIds;
    /**
     * true-启用识别；false-禁用识别
     */
    private $enable;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setDeviceIds($deviceIds)
    {
        $this->deviceIds = $deviceIds;
        $this->apiParas['device_ids'] = $deviceIds;
    }

    public function getDeviceIds()
    {
        return $this->deviceIds;
    }

    public function setEnable($enable)
    {
        $this->enable = $enable;
        $this->apiParas['enable'] = $enable;
    }

    public function getEnable()
    {
        return $this->enable;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.facegroup.enable';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkMaxLength($this->bizId, 23, 'bizId');
        RequestCheckUtil::checkMaxListSize($this->deviceIds, 20, 'deviceIds');
        RequestCheckUtil::checkNotNull($this->enable, 'enable');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
