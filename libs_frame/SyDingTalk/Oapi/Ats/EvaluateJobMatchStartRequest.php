<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.evaluate.jobmatch.start request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.09
 */
class EvaluateJobMatchStartRequest extends BaseRequest
{
    /**
     * 招聘业务标识
     */
    private $bizCode;
    /**
     * 候选人id
     */
    private $candidateId;
    /**
     * 职位类型码，调用时请申请职位类型码表
     */
    private $category;
    /**
     * json格式的字符串，存放请求扩展信息
     */
    private $extData;
    /**
     * 邀请填写测评的url
     */
    private $inviteUrl;
    /**
     * 候选人id
     */
    private $jobId;
    /**
     * 外部测评系统的具体某一次测评的id，全局唯一
     */
    private $outerEvaluateId;
    /**
     * 测评结果的url
     */
    private $resultUrl;

    public function setBizCode($bizCode)
    {
        $this->bizCode = $bizCode;
        $this->apiParas['biz_code'] = $bizCode;
    }

    public function getBizCode()
    {
        return $this->bizCode;
    }

    public function setCandidateId($candidateId)
    {
        $this->candidateId = $candidateId;
        $this->apiParas['candidate_id'] = $candidateId;
    }

    public function getCandidateId()
    {
        return $this->candidateId;
    }

    public function setCategory($category)
    {
        $this->category = $category;
        $this->apiParas['category'] = $category;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setExtData($extData)
    {
        $this->extData = $extData;
        $this->apiParas['ext_data'] = $extData;
    }

    public function getExtData()
    {
        return $this->extData;
    }

    public function setInviteUrl($inviteUrl)
    {
        $this->inviteUrl = $inviteUrl;
        $this->apiParas['invite_url'] = $inviteUrl;
    }

    public function getInviteUrl()
    {
        return $this->inviteUrl;
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

    public function setOuterEvaluateId($outerEvaluateId)
    {
        $this->outerEvaluateId = $outerEvaluateId;
        $this->apiParas['outer_evaluate_id'] = $outerEvaluateId;
    }

    public function getOuterEvaluateId()
    {
        return $this->outerEvaluateId;
    }

    public function setResultUrl($resultUrl)
    {
        $this->resultUrl = $resultUrl;
        $this->apiParas['result_url'] = $resultUrl;
    }

    public function getResultUrl()
    {
        return $this->resultUrl;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.evaluate.jobmatch.start';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->candidateId, 'candidateId');
        RequestCheckUtil::checkNotNull($this->category, 'category');
        RequestCheckUtil::checkNotNull($this->extData, 'extData');
        RequestCheckUtil::checkNotNull($this->inviteUrl, 'inviteUrl');
        RequestCheckUtil::checkNotNull($this->jobId, 'jobId');
        RequestCheckUtil::checkNotNull($this->outerEvaluateId, 'outerEvaluateId');
        RequestCheckUtil::checkNotNull($this->resultUrl, 'resultUrl');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
