<?php

namespace SyDingTalk\Oapi\Pbp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.pbp.instance.group.position.list request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.20
 */
class InstanceGroupPositionListRequest extends BaseRequest
{
    /**
     * 业务唯一标识
     */
    private $bizId;
    /**
     * 游标，用于分页查询
     */
    private $cursor;
    /**
     * 打卡组唯一标识，由创建打卡组接口返回
     */
    private $punchGroupId;
    /**
     * 分页请求数量
     */
    private $size;

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

    public function setPunchGroupId($punchGroupId)
    {
        $this->punchGroupId = $punchGroupId;
        $this->apiParas['punch_group_id'] = $punchGroupId;
    }

    public function getPunchGroupId()
    {
        return $this->punchGroupId;
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
        return 'dingtalk.oapi.pbp.instance.group.position.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->punchGroupId, 'punchGroupId');
        RequestCheckUtil::checkNotNull($this->size, 'size');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
