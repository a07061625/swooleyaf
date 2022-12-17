<?php

namespace SyDingTalk\Corp\Device;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.device.manage.querylist request
 *
 * @author auto create
 *
 * @since 1.0, 2019.08.14
 */
class ManageQueryListRequest extends BaseRequest
{
    /**
     * 分页拉取设备列表的游标，首次拉取可传Null或者0
     */
    private $cursor;
    /**
     * 设备服务商ID
     */
    private $deviceServiceId;
    /**
     * 单次请求的大小，最大不超过20
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

    public function setDeviceServiceId($deviceServiceId)
    {
        $this->deviceServiceId = $deviceServiceId;
        $this->apiParas['device_service_id'] = $deviceServiceId;
    }

    public function getDeviceServiceId()
    {
        return $this->deviceServiceId;
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
        return 'dingtalk.corp.device.manage.querylist';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->deviceServiceId, 'deviceServiceId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 20, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
