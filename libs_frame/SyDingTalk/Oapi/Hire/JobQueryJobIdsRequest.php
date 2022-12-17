<?php

namespace SyDingTalk\Oapi\Hire;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hire.job.queryjobids request
 *
 * @author auto create
 *
 * @since 1.0, 2021.03.02
 */
class JobQueryJobIdsRequest extends BaseRequest
{
    /**
     * 查询参数
     */
    private $queryParam;
    /**
     * 员工标识
     */
    private $userid;

    public function setQueryParam($queryParam)
    {
        $this->queryParam = $queryParam;
        $this->apiParas['query_param'] = $queryParam;
    }

    public function getQueryParam()
    {
        return $this->queryParam;
    }

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas['userid'] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.hire.job.queryjobids';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, 'userid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
