<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.attendance.list request
 *
 * @author auto create
 *
 * @since 1.0, 2018.08.31
 */
class ListRequest extends BaseRequest
{
    /**
     * 是否国际化
     */
    private $isI18n;
    /**
     * 表示获取考勤数据的条数，最大不能超过50条
     */
    private $limit;
    /**
     * 表示获取考勤数据的起始点，第一次传0，如果还有多余数据，下次获取传的offset值为之前的offset+limit
     */
    private $offset;
    /**
     * 员工在企业内的UserID列表，企业用来唯一标识用户的字段
     */
    private $userIdList;
    /**
     * 查询考勤打卡记录的起始工作日
     */
    private $workDateFrom;
    /**
     * 查询考勤打卡记录的结束工作日
     */
    private $workDateTo;

    public function setIsI18n($isI18n)
    {
        $this->isI18n = $isI18n;
        $this->apiParas['isI18n'] = $isI18n;
    }

    public function getIsI18n()
    {
        return $this->isI18n;
    }

    public function setLimit($limit)
    {
        $this->limit = $limit;
        $this->apiParas['limit'] = $limit;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function setOffset($offset)
    {
        $this->offset = $offset;
        $this->apiParas['offset'] = $offset;
    }

    public function getOffset()
    {
        return $this->offset;
    }

    public function setUserIdList($userIdList)
    {
        $this->userIdList = $userIdList;
        $this->apiParas['userIdList'] = $userIdList;
    }

    public function getUserIdList()
    {
        return $this->userIdList;
    }

    public function setWorkDateFrom($workDateFrom)
    {
        $this->workDateFrom = $workDateFrom;
        $this->apiParas['workDateFrom'] = $workDateFrom;
    }

    public function getWorkDateFrom()
    {
        return $this->workDateFrom;
    }

    public function setWorkDateTo($workDateTo)
    {
        $this->workDateTo = $workDateTo;
        $this->apiParas['workDateTo'] = $workDateTo;
    }

    public function getWorkDateTo()
    {
        return $this->workDateTo;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.attendance.list';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
