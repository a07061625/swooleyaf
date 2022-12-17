<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.job.batchadd request
 *
 * @author auto create
 *
 * @since 1.0, 2022.04.19
 */
class JobBatchAddRequest extends BaseRequest
{
    /**
     * 招聘业务标识
     */
    private $bizCode;
    /**
     * 职位列表，单次最多20个
     */
    private $jobs;
    /**
     * 操作人员工标识
     */
    private $opUserId;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setJobs($jobs)
    {
        $this->jobs = $jobs;
        $this->apiParas['jobs'] = $jobs;
    }

    public function getJobs()
    {
        return $this->jobs;
    }

    public function setOpUserId($opUserId)
    {
        $this->opUserId = $opUserId;
        $this->apiParas['op_user_id'] = $opUserId;
    }

    public function getOpUserId()
    {
        return $this->opUserId;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.job.batchadd';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->opUserId, 'opUserId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
