<?php

namespace SyDingTalk\Oapi\OpenEncrypt;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.openencrypt.encryptbox.status.update request
 *
 * @author auto create
 *
 * @since 1.0, 2020.05.07
 */
class EncryptBoxStatusUpdateRequest extends BaseRequest
{
    /**
     * 请求参数
     */
    private $topEncryptBoxStatus;

    public function setTopEncryptBoxStatus($topEncryptBoxStatus)
    {
        $this->topEncryptBoxStatus = $topEncryptBoxStatus;
        $this->apiParas['top_encrypt_box_status'] = $topEncryptBoxStatus;
    }

    public function getTopEncryptBoxStatus()
    {
        return $this->topEncryptBoxStatus;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.openencrypt.encryptbox.status.update';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
