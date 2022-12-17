<?php

namespace SyDingTalk\Oapi\Report;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.report.getunreadcount request
 *
 * @author auto create
 *
 * @since 1.0, 2019.07.03
 */
class GetUnreadCountRequest extends BaseRequest
{
    /**
     * 员工id
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
        return 'dingtalk.oapi.report.getunreadcount';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
