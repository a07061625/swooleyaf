<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;
use SyDingTalk\RequestCheckUtil;

/**
 * dingtalk API: dingtalk.oapi.process.gettodonum request
 * @author auto create
 * @since 1.0, 2019.07.03
 */
class GetTodoNumRequest extends BaseRequest
{
    /**
     * 用户id
     **/
    private $userid;

    public function setUserid($userid)
    {
        $this->userid = $userid;
        $this->apiParas["userid"] = $userid;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.process.gettodonum";
    }

    /**
     * @throws \Exception
     */
    public function check()
    {
        RequestCheckUtil::checkNotNull($this->userid, "userid");
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
