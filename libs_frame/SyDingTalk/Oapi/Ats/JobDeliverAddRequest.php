<?php

namespace SyDingTalk\Oapi\Ats;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.ats.job.deliver.add request
 *
 * @author auto create
 *
 * @since 1.0, 2020.08.04
 */
class JobDeliverAddRequest extends BaseRequest
{
    /**
     * 业务唯一标识，接入前请提前沟通
     */
    private $bizCode;
    /**
     * 投递渠道, 接入前请提前沟通
     */
    private $deliverChannel;
    /**
     * 失败原因
     */
    private $deliverMsg;
    /**
     * 渠道中的一次职位外投的唯一id，如需要更新deliver_status该入参必传
     */
    private $deliverOuterId;
    /**
     * 投递中:created,投递失败:fail,投递成功:success,已下架:off_shelf
     */
    private $deliverStatus;
    /**
     * 智能招聘职位id
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

    public function setDeliverChannel($deliverChannel)
    {
        $this->deliverChannel = $deliverChannel;
        $this->apiParas['deliver_channel'] = $deliverChannel;
    }

    public function getDeliverChannel()
    {
        return $this->deliverChannel;
    }

    public function setDeliverMsg($deliverMsg)
    {
        $this->deliverMsg = $deliverMsg;
        $this->apiParas['deliver_msg'] = $deliverMsg;
    }

    public function getDeliverMsg()
    {
        return $this->deliverMsg;
    }

    public function setDeliverOuterId($deliverOuterId)
    {
        $this->deliverOuterId = $deliverOuterId;
        $this->apiParas['deliver_outer_id'] = $deliverOuterId;
    }

    public function getDeliverOuterId()
    {
        return $this->deliverOuterId;
    }

    public function setDeliverStatus($deliverStatus)
    {
        $this->deliverStatus = $deliverStatus;
        $this->apiParas['deliver_status'] = $deliverStatus;
    }

    public function getDeliverStatus()
    {
        return $this->deliverStatus;
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
        return 'dingtalk.oapi.ats.job.deliver.add';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->bizCode, 'bizCode');
        RequestCheckUtil::checkNotNull($this->deliverChannel, 'deliverChannel');
        RequestCheckUtil::checkNotNull($this->deliverStatus, 'deliverStatus');
        RequestCheckUtil::checkNotNull($this->jobId, 'jobId');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
