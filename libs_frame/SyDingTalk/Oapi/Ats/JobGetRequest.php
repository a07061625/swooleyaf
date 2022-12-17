<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.job.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.25
 */
class JobGetRequest extends BaseRequest
{
    /**
     * 业务唯一标识，接入前请提前沟通
     */
    private $bizCode;
    /**
     * 职位唯一标识
     */
    private $jobId;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setJobId($jobId)
    {
        $this->jobId = $jobId;
        $this->apiParas['job_id'] = $jobId;
    }

    public function getJobId()
    {
        return $this->jobId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.job.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->jobId, 'jobId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
