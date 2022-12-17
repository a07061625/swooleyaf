<?php

namespace SyDingTalk\Corp\Health;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.corp.health.stepinfo.listbyuserid request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class StepInfoListByUserIdRequest extends BaseRequest
{
    /**
     * 时间，注意时间格式是YYMMDD
     */
    private $statDate;
    /**
     * 员工userid列表，最多传50个
     */
    private $userids;

    public function setStatDate($statDate)
    {
        $this->statDate = $statDate;
        $this->apiParas['stat_date'] = $statDate;
    }

    public function getStatDate()
    {
        return $this->statDate;
    }

    public function setUserids($userids)
    {
        $this->userids = $userids;
        $this->apiParas['userids'] = $userids;
    }

    public function getUserids()
    {
        return $this->userids;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.corp.health.stepinfo.listbyuserid';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->statDate, 'statDate');
        RequestCheckUtil::checkNotNull($this->userids, 'userids');
        RequestCheckUtil::checkMaxListSize($this->userids, 50, 'userids');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
