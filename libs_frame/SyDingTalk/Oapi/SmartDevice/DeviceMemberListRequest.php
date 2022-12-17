<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.devicemember.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.08
 */
class DeviceMemberListRequest extends BaseRequest
{
    /**
     * 查询游标，起始传0，后续传返回值中的cursor字段
     */
    private $cursor;
    /**
     * 设备id
     */
    private $deviceId;
    /**
     * 分页大小
     */
    private $size;

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setDeviceId($deviceId)
    {
        $this->deviceId = $deviceId;
        $this->apiParas['device_id'] = $deviceId;
    }

    public function getDeviceId()
    {
        return $this->deviceId;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.devicemember.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->deviceId, 'deviceId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 500, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
