<?php

namespace SyDingTalk\Oapi\Edu;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.edu.student.attendance.statistics.get request
 *
 * @author auto create
 *
 * @since 1.0, 2020.12.24
 */
class StudentAttendanceStatisticsGetRequest extends BaseRequest
{
    /**
     * 指定获取哪一天的数据，格式为yyyyMMdd
     */
    private $date;
    /**
     * 当前操作人的用户ID
     */
    private $opUserid;
    /**
     * 指定获取那个学校的数据，学校的CorpId
     */
    private $schoolCorpid;

    public function setDate($date)
    {
        $this->date = $date;
        $this->apiParas['date'] = $date;
    }

    public function getDate()
    {
        return $this->date;
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

    public function setSchoolCorpid($schoolCorpid)
    {
        $this->schoolCorpid = $schoolCorpid;
        $this->apiParas['school_corpid'] = $schoolCorpid;
    }

    public function getSchoolCorpid()
    {
        return $this->schoolCorpid;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.edu.student.attendance.statistics.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->date, 'date');
        RequestCheckUtil::checkNotNull($this->opUserid, 'opUserid');
        RequestCheckUtil::checkNotNull($this->schoolCorpid, 'schoolCorpid');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
