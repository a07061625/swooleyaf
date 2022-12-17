<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.facegroup.device.list request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FaceGroupDeviceListRequest extends BaseRequest
{
    /**
     * 业务id
     */
    private $bizId;
    /**
     * 游标，第一次传 <=0的值，后续传本调用的返回值
     */
    private $cursor;
    /**
     * 查询模式：all-企业所有设备；bound-本组已关联设备
     */
    private $mode;
    /**
     * 分页大小
     */
    private $size;
    /**
     * 需查询的设备类型
     */
    private $type;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function setCursor($cursor)
    {
        $this->cursor = $cursor;
        $this->apiParas['cursor'] = $cursor;
    }

    public function getCursor()
    {
        return $this->cursor;
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        $this->apiParas['mode'] = $mode;
    }

    public function getMode()
    {
        return $this->mode;
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

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.facegroup.device.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkMaxLength($this->bizId, 23, 'bizId');
        RequestCheckUtil::checkNotNull($this->cursor, 'cursor');
        RequestCheckUtil::checkNotNull($this->mode, 'mode');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 20, 'size');
        RequestCheckUtil::checkMinValue($this->size, 1, 'size');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
