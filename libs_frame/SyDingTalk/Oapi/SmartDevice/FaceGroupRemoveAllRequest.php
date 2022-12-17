<?php

namespace SyDingTalk\Oapi\SmartDevice;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.smartdevice.facegroup.removeall request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.01
 */
class FaceGroupRemoveAllRequest extends BaseRequest
{
    /**
     * 业务id
     */
    private $bizId;

    public function setBizId($bizId)
    {
        $this->bizId = $bizId;
        $this->apiParas['biz_id'] = $bizId;
    }

    public function getBizId()
    {
        return $this->bizId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.smartdevice.facegroup.removeall';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizId, 'bizId');
        RequestCheckUtil::checkMaxLength($this->bizId, 23, 'bizId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
