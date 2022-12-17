<?php

namespace SyDingTalk\Oapi\Hrm;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.hrm.employee.get request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class EmployeeGetRequest extends BaseRequest
{
    /**
     * 查询用户userid
     */
    private $userid;

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
        return 'dingtalk.oapi.hrm.employee.get';
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
