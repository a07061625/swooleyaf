<?php

namespace SyDingTalk\Corp\SmartDevice;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.corp.smartdevice.getface request
 *
 * @author auto create
 *
 * @since 1.0, 2019.09.03
 */
class GetFaceRequest extends BaseRequest
{
    /**
     * 员工ID
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
        return 'dingtalk.corp.smartdevice.getface';
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->{$key} = $value;
    }
}
