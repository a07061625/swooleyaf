<?php

namespace SyDingTalk\Oapi\Attendance;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.attendance.vacation.quota.list request
 *
 * @author auto create
 *
 * @since 1.0, 2021.04.25
 */
class VacationQuotaListRequest extends BaseRequest
{
    /**
     * 假期类型唯一标识
     */
    private $leaveCode;
    /**
     * 分页偏移(从0开始非负整数)
     */
    private $offset;
    /**
     * 操作者ID
     */
    private $opUserid;
    /**
     * 分页偏移(正整数 最大200)
     */
    private $size;
    /**
     * 待查询的员工ID列表
     */
    private $userids;

    public function setLeaveCode($leaveCode)
    {
        $this->leaveCode = $leaveCode;
        $this->apiParas['leave_code'] = $leaveCode;
    }

    public function getLeaveCode()
    {
        return $this->leaveCode;
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

    public function setOpUserid($opUserid)
    {
        $this->opUserid = $opUserid;
        $this->apiParas['op_userid'] = $opUserid;
    }

    public function getOpUserid()
    {
        return $this->opUserid;
    }

    public function setSize($size)
    {
        $this->size = $size;
        $this->apiParas['size'] = $size;
    }

    public function getSize()
    {
        return $this->size;
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
        return 'dingtalk.oapi.attendance.vacation.quota.list';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->leaveCode, 'leaveCode');
        RequestCheckUtil::checkNotNull($this->offset, 'offset');
        RequestCheckUtil::checkMinValue($this->offset, 0, 'offset');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->size, 'size');
        RequestCheckUtil::checkMaxValue($this->size, 200, 'size');
        RequestCheckUtil::checkNotNull($this->userids, 'userids');
        RequestCheckUtil::checkMaxListSize($this->userids, 50, 'userids');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
