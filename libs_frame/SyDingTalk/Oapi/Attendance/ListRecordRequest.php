<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.listRecord request
 *
 * @author auto create
 *
 * @since 1.0, 2020.07.28
 */
class ListRecordRequest extends BaseRequest
{
    /**
     * 查询考勤打卡记录的结束工作日。注意，起始与结束工作日最多相隔7天
     */
    private $checkDateFrom;
    /**
     * 查询考勤打卡记录的结束工作日。注意，起始与结束工作日最多相隔7天
     */
    private $checkDateTo;
    /**
     * 是否国际化
     */
    private $isI18n;
    /**
     * 企业内的员工id列表，最多不能超过50个
     */
    private $userIds;

    public function setCheckDateFrom($checkDateFrom)
    {
        $this->checkDateFrom = $checkDateFrom;
        $this->apiParas['checkDateFrom'] = $checkDateFrom;
    }

    public function getCheckDateFrom()
    {
        return $this->checkDateFrom;
    }

    public function setCheckDateTo($checkDateTo)
    {
        $this->checkDateTo = $checkDateTo;
        $this->apiParas['checkDateTo'] = $checkDateTo;
    }

    public function getCheckDateTo()
    {
        return $this->checkDateTo;
    }

    public function setIsI18n($isI18n)
    {
        $this->isI18n = $isI18n;
        $this->apiParas['isI18n'] = $isI18n;
    }

    public function getIsI18n()
    {
        return $this->isI18n;
    }

    public function setUserIds($userIds)
    {
        $this->userIds = $userIds;
        $this->apiParas['userIds'] = $userIds;
    }

    public function getUserIds()
    {
        return $this->userIds;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.listRecord';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->checkDateFrom, 'checkDateFrom');
        RequestCheckUtil::checkNotNull($this->checkDateTo, 'checkDateTo');
        RequestCheckUtil::checkNotNull($this->userIds, 'userIds');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
