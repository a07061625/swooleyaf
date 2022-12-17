<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.homework.query request
 *
 * @author auto create
 *
 * @since 1.0, 2020.04.28
 */
class HomeworkQueryRequest extends BaseRequest
{
    /**
     * 业务编码
     */
    private $bizCode;
    /**
     * 作业ID
     */
    private $hwId;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setHwId($hwId)
    {
        $this->hwId = $hwId;
        $this->apiParas['hw_id'] = $hwId;
    }

    public function getHwId()
    {
        return $this->hwId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.homework.query';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->hwId, 'hwId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
