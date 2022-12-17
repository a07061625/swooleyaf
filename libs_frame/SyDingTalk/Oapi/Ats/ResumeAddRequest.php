<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.resume.add request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.26
 */
class ResumeAddRequest extends BaseRequest
{
    /**
     * 业务唯一标识，接入前请提前沟通
     */
    private $bizCode;
    /**
     * 简历文件参数
     */
    private $param;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setParam($param)
    {
        $this->param = $param;
        $this->apiParas['param'] = $param;
    }

    public function getParam()
    {
        return $this->param;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.resume.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
