<?php

namespace SyDingTalk\Oapi\Process;

use SyDingTalk\BaseRequest;

/**
 * dingtalk API: dingtalk.oapi.process.procmanager.get request
 * @author auto create
 * @since 1.0, 2020.09.24
 */
class ProcManagerGetRequest extends BaseRequest
{
    /**
     * 入参
     **/
    private $request;

    public function setRequest($request)
    {
        $this->request = $request;
        $this->apiParas["request"] = $request;
    }

    public function getRequest()
    {
        return $this->request;
    }

    public function getApiMethodName() : string
    {
        return "dingtalk.oapi.process.procmanager.get";
    }

    public function putOtherTextParam($key, $value)
    {
        $this->apiParas[$key] = $value;
        $this->$key = $value;
    }
}
