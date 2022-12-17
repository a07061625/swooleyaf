<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.resume.checkexistence request
 *
 * @author auto create
 *
 * @since 1.0, 2020.10.26
 */
class ResumeCheckexistenceRequest extends BaseRequest
{
    /**
     * 业务唯一标识
     */
    private $bizCode;
    /**
     * 结构化简历详情
     */
    private $resumeDetailInfo;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setResumeDetailInfo($resumeDetailInfo)
    {
        $this->resumeDetailInfo = $resumeDetailInfo;
        $this->apiParas['resume_detail_info'] = $resumeDetailInfo;
    }

    public function getResumeDetailInfo()
    {
        return $this->resumeDetailInfo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.resume.checkexistence';
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
