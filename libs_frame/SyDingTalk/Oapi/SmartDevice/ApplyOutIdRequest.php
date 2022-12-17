<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.applyoutid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class ApplyOutIdRequest extends BaseRequest
{
    /**
     * 设备类型id
     */
    private $devServId;
    /**
     * 设备序列号
     */
    private $sn;

    public function setDevServId($devServId)
    {
        $this->devServId = $devServId;
        $this->apiParas['dev_serv_id'] = $devServId;
    }

    public function getDevServId()
    {
        return $this->devServId;
    }

    public function setSn($sn)
    {
        $this->sn = $sn;
        $this->apiParas['sn'] = $sn;
    }

    public function getSn()
    {
        return $this->sn;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.applyoutid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->devServId, 'devServId');
        RequestCheckUtil::checkNotNull($this->sn, 'sn');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
