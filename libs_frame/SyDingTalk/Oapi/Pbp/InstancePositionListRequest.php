<?php

namespace SyDingTalk\Oapi\Pbp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.pbp.instance.position.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.07
 */
class InstancePositionListRequest extends BaseRequest
{
    /**
     * 业务唯一标识，由系统分配
     */
    private $bizId;
    /**
     * 业务实例唯一标识，由创建示例接口返回
     */
    private $bizInstId;
    /**
     * 游标，用于分页查询
     */
    private $cursor;
    /**
     * 查询数据量
     */
    private $size;
    /**
     * 位置类型，如100代表硬件B1设备
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

    public function setBizInstId($bizInstId)
    {
        $this->bizInstId = $bizInstId;
        $this->apiParas['biz_inst_id'] = $bizInstId;
    }

    public function getBizInstId()
    {
        return $this->bizInstId;
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
        return 'dingtalk.oapi.pbp.instance.position.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkNotNull($this->bizInstId, 'bizInstId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkNotNull($this->type, 'type');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
