<?php

namespace SyDingTalk\Oapi\Kac;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.kac.datav.annual_report.get request
 *
 * @author auto create
 *
 * @since 1.0, 2021.12.24
 */
class DatavAnnualReportGetRequest extends BaseRequest
{
    /**
     * 部门id，当type=2时该参数需存在
     */
    private $deptId;
    /**
     * 年报的数据维度，1-企业维度，2-部门维度，3-员工维度（员工维度的数据需要额外授权，请联系对接BD)
     */
    private $type;
    /**
     * 用户id，当type=3时该参数需存在
     */
    private $userId;
    /**
     * 年份标识
     */
    private $year;

    public function setDeptId($deptId)
    {
        $this->deptId = $deptId;
        $this->apiParas['dept_id'] = $deptId;
    }

    public function getDeptId()
    {
        return $this->deptId;
    }

    public function setType($type)
    {
        $this->type = $type;
        $this->apiParas['type'] = $type;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        $this->apiParas['user_id'] = $userId;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setYear($year)
    {
        $this->year = $year;
        $this->apiParas['year'] = $year;
    }

    public function getYear()
    {
        return $this->year;
    }

    public function getApiMethodName(): string
    {
        return 'dingtalk.oapi.kac.datav.annual_report.get';
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->type, 'type');
        RequestCheckUtil::checkMaxLength($this->userId, 128, 'userId');
        RequestCheckUtil::checkNotNull($this->year, 'year');
        RequestCheckUtil::checkMaxLength($this->year, 32, 'year');
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
