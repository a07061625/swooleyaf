<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.candidate.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.30
 */
class CandidateGetRequest extends BaseRequest
{
    /**
     * 招聘业务标识
     */
    private $bizCode;
    /**
     * 候选人id
     */
    private $candidateId;

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

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.ats.candidate.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->candidateId, 'candidateId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
