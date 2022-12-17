<?php

namespace SyDingTalk\Oapi\Pbp;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.pbp.instance.enable request
 *
 * @author auto create
 *
 * @since 1.0, 2020.01.19
 */
class InstanceEnableRequest extends BaseRequest
{
    /**
     * 业务唯一标识
     */
    private $bizId;
    /**
     * 业务实例唯一标识
     */
    private $bizInstId;

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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.pbp.instance.enable';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkNotNull($this->bizInstId, 'bizInstId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
